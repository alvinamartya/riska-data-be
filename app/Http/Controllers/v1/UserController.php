<?php

namespace App\Http\Controllers\v1;

use App\Constants\HttpStatusCode;
use App\Constants\ImportMethod;
use App\Http\Controllers\Controller;
use App\Http\RestResponse;
use App\Models\User;
use DB;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
  {
    $users = User::orderBy('fullname');
    return RestResponse::data($users->paginate());
  }

  public function show(User $user)
  {
    return RestResponse::data($user);
  }

  public function update(Request $request, User $user)
  {
    $user->whatsapp_number = $this->sanitizeWhatsapp($request->get("whatsapp_number"));
    $user->save();
    return RestResponse::updated(User::class);
  }

  public function import(Request $request)
  {
    if (!$request->hasFile('file')) return RestResponse::badRequest("file is required");
    $file = $request->file('file');
    $method = $request->input('method', ImportMethod::APPEND_NEW);

    try {
      DB::beginTransaction();

      $records = fastexcel()->import($file->getPathname());
      foreach ($records as $record) {
        $whatsapp = $this->sanitizeWhatsapp($record['whatsapp_number']);
        $user = false;
        if (!empty($whatsapp)) $user = User::whereWhatsappNumber($whatsapp)->first();
        if (!$user) $user = User::whereEmail($record['email'])->first();

        $isNewRecord = true;

        if ($user) $isNewRecord = false;
        else {
          $user = new User;
          $user->provider_name = "import";
        }

        if ($isNewRecord || (!$isNewRecord && $method === ImportMethod::APPEND_ALL)) {
          $user->fullname = $this->nullIfEmpty(ucwords($record['fullname']));
          $user->nickname = $this->nullIfEmpty(ucwords($record['nickname']));
          $user->email = $this->nullIfEmpty(strtolower($record['email']));
          $user->address = $this->nullIfEmpty($record['address']);
          $user->birth_date = empty($record['birth_date']) ? null : $record['birth_date']->format('Y-m-d');
          $user->birth_place = $this->nullIfEmpty(ucwords($record['birth_place']));
          $user->whatsapp_number = $this->nullIfEmpty($whatsapp);
          $user->phone_number = $this->sanitizePhone($record['phone_number']);
          $user->education_grade = $this->nullIfEmpty(strtoupper($record['education']));
          $user->field_of_work = $this->nullIfEmpty(ucwords($record['job']));
          if ($record['gender'] == 'F') $user->gender = 0;
          else if ($record['gender'] == 'M') $user->gender = 1;
        }

        $user->save();
      }
      DB::commit();
    } catch (Exception $e) {
      DB::rollBack();
      return RestResponse::data(['error' => $e->getMessage(), 'record' => $record], HttpStatusCode::SERVER_ERROR);
    }
    return RestResponse::updated(User::class);
  }

  private function sanitizeWhatsapp($phoneNumber) {
    if (empty($phoneNumber)) return "";
    $phoneNumber = $this->sanitizePhone($phoneNumber);
    if (substr($phoneNumber, 0, 1) == "0") $phoneNumber = "62" . substr($phoneNumber, 1);
    return $phoneNumber;
  }

  private function sanitizePhone($phoneNumber) {
    if (empty($phoneNumber)) return "";
    $phoneNumber = str_replace(["+", "-", " "], "", $phoneNumber);
    if (substr($phoneNumber, 0, 1) == "8") $phoneNumber = "0" . $phoneNumber;
    return $phoneNumber;
  }

  private function nullIfEmpty($value) {
    return empty($value) ? null : $value;
  }
}
