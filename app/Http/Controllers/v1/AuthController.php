<?php

namespace App\Http\Controllers\v1;

use App\Constants\HttpStatusCode;
use App\Constants\WhatsappOutboxStatus;
use App\Http\Controllers\Controller;
use App\Http\RestResponse;
use App\Models\ConfirmationCode;
use App\Models\User;
use App\Models\WhatsappOutbox;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends Controller
{
  /** @var Provider */
  protected $socialite;

  /**
   * Create a new AuthController instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['login', 'loginByWhatsapp', 'callback']]);
    $this->socialite = Socialite::driver("google")->stateless();
  }

  /**
   * Redirect the user to the provider authentication page.
   *
   * @return RedirectResponse
   */
  public function login()
  {
    return $this->socialite->redirect();
  }

  /**
   * Obtain the user information from provider.
   *
   * @return JsonResponse
   */
  public function callback()
  {
    /** @var User $user */
    try {
      $login = $this->socialite->user();
    } catch (Exception $e) {
      return RestResponse::error($e, HttpStatusCode::BAD_REQUEST);
    }

    $user = User::whereEmail($login->getEmail())->first();
    if (!$user) $user = new User;
    if (empty($user->fullname)) $user->fullname = $login->getName();
    if (empty($user->photo)) $user->photo = $login->getAvatar();
    if (empty($user->provider_name)) $user->provider_name = "google";
    if (empty($user->provider_id)) $user->provider_id = $login->getId();
    if (empty($user->email)) $user->email = $login->getEmail();
    $user->save();

    return $this->respondWithToken(auth()->login($user));
  }

  /**
   * Redirect the user to the provider authentication page.
   *
   * @return JsonResponse
   */
  public function loginByWhatsapp(Request $request)
  {
    $id = $request->get('id');
    $code = $request->get('code');
    $action = implode(".", ["login", $id]);

    if (!$id) return RestResponse::badRequest('Missing required parameters.');

    if (!$code) {
      $pin = ConfirmationCode::createCode($action);

      $outbox = new WhatsappOutbox();
      $outbox->owner = config('services.whatsapp.client_id');
      $outbox->to = "{$id}@c.us";
      $outbox->message = "Ssst, kode ini rahasia ya 🤫\nJangan kasih tau siapapun, nanti dia bisa masuk ke akun kamu!\n\nKode login kamu *$pin[0] $pin[1] $pin[2] $pin[3] $pin[4] $pin[5]*\nKode tersebut hanya berlaku 30 menit.";
      $outbox->option = null;
      $outbox->status = WhatsappOutboxStatus::PENDING;
      $outbox->save();

      return RestResponse::data(["message" => "confirmation code has been sent"]);
    }

    $user = User::whereWhatsappNumber($id)->first();
    if (!$user) $user = new User;
    if (empty($user->provider_name)) $user->provider_name = "whatsapp";
    if (empty($user->provider_id)) $user->provider_id = "{$id}@c.us";
    if (empty($user->whatsapp_number)) $user->whatsapp_number = $id;

    if (!ConfirmationCode::isCodeMatch($action, $code)) return RestResponse::badRequest("confirmation code is not match.");
    ConfirmationCode::remove($action);

    $user->save();
    return $this->respondWithToken(auth()->login($user));
  }

  /**
   * Get the token array structure.
   *
   * @param string $token
   *
   * @return JsonResponse
   */
  protected function respondWithToken($token)
  {
    $response = [
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth()->factory()->getTTL() * 60
    ];
    return RestResponse::data($response);
  }

  /**
   * Get the authenticated User.
   *
   * @return JsonResponse
   */
  public function me()
  {
    /** @var User $user */
    $user = auth()->user();
    $roles = $user->roles()->get();
    $permissions = [];
    foreach ($roles as $role) {
      $permissions = array_merge($permissions, $role->permissions->pluck('name')->all());
    }
    return RestResponse::data(['profile' => $user, 'roles' => $roles->pluck('name')->all(), 'permissions' => $permissions]);
  }

  /**
   * Log the user out (Invalidate the token).
   *
   * @return JsonResponse
   */
  public function logout()
  {
    auth()->logout();
    return RestResponse::message('Successfully logged out');

  }

  /**
   * Refresh a token.
   *
   * @return JsonResponse
   */
  public function refresh()
  {
    return $this->respondWithToken(auth()->refresh());
  }
}
