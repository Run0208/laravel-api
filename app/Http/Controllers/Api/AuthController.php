<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api')->except('login');
  }

  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');
    if (!$token = auth()->attempt($credentials)) {
      return response()->json(['success' => false], 401);
    }
    return response()->json(['success' => true, 'token' => $token], 200);
  }

  public function checkToken()
  {
    return response()->json(['success'=>true], 200);
  }

  public function logout() {
    $logout = auth()->logout();
    return response()->json(['success'=>true], 200);
  }
}
