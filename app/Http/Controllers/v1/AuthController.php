<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Facades\Socialite;

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
    $this->middleware('auth:api', ['except' => ['login', 'callback']]);
    $this->socialite = Socialite::driver("google")->stateless();
  }

  /**
   * Redirect the user to the provider authentication page.
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function login()
  {
    return $this->socialite->redirect();
  }

  /**
   * Obtain the user information from provider.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function callback()
  {
    /** @var User $user */
    try {
      $login = $this->socialite->user();
    } catch (\Exception $e) {
      return response()->json($e, 400);
    }

    $user = User::whereEmail($login->getEmail())->first();
    if (!$user) {
      $user                    = new User;
      $user->fullname = $login->getName();
      $user->photo = $login->getAvatar();
      $user->provider_name     = "google";
      $user->provider_id       = $login->getId();
      $user->email             = $login->getEmail();
      $user->save();
    }

    return $this->respondWithToken(auth()->login($user));
  }

  /**
   * Get the authenticated User.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function me()
  {
    /** @var User $user */
    $user = auth()->user();
    $roles = $user->roles;
    $permissions = [];
    foreach ($roles as $role) {
      $permissions = array_merge($permissions, $role->permissions->pluck('name')->all());
    }
    return response()->json(['profile' => $user, 'roles' => $roles->pluck('name')->all(), 'permissions' => $permissions]);
  }

  /**
   * Log the user out (Invalidate the token).
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function logout()
  {
    auth()->logout();
    return response()->json(['message' => 'Successfully logged out']);
  }

  /**
   * Refresh a token.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function refresh()
  {
    return $this->respondWithToken(auth()->refresh());
  }

  /**
   * Get the token array structure.
   *
   * @param  string $token
   *
   * @return \Illuminate\Http\JsonResponse
   */
  protected function respondWithToken($token)
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth()->factory()->getTTL() * 60
    ]);
  }
}
