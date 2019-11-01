<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
  /**
   * A list of the exception types that are not reported.
   *
   * @var array
   */
  protected $dontReport = [
    //
  ];

  /**
   * A list of the inputs that are never flashed for validation exceptions.
   *
   * @var array
   */
  protected $dontFlash = [
    'password',
    'password_confirmation',
  ];

  /**
   * Report or log an exception.
   *
   * @param \Exception $exception
   * @return void
   * @throws Exception
   */
  public function report(Exception $exception)
  {
    parent::report($exception);
  }

  /**
   * Render an exception into an HTTP response.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Exception $exception
   * @return \Illuminate\Http\Response
   */

  public function render($request, Exception $exception)
  {
    // This will replace all api exception with
    // a JSON response.
    if (substr($request->getPathInfo(), 0, 5) == "/api/" || ($request->route() != null && in_array("api", $request->route()->middleware()))) {
      $status_code = 500;
      $msg = $exception->getMessage();
      if ($exception instanceof ModelNotFoundException) $status_code = 404;
      else if ($exception instanceof AuthenticationException) $status_code = 401;
      else if ($exception instanceof NotFoundHttpException) {
        $status_code = 404;
        $msg = "API not found";
      }
      return response()->json(['error' => $msg], $status_code);
    }

    return parent::render($request, $exception);
  }
}
