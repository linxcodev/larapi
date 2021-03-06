<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
  public function signup(Request $request)
  {
    $request->validate([
      'username' => 'required|unique:users',
      'email' => 'required|unique:users',
      'password' => 'required'
    ]);

    $user = User::create([
      'username' => $request->json('username'),
      'email' => $request->json('email'),
      'password' => bcrypt($request->json('password'))
    ]);

    return $user;
  }

  // user login dapat token
  public function signin(Request $request)
  {
    $request->validate([
      'username' => 'required',
      'password' => 'required'
    ]);

    // grab credentials from the request
    $credentials = $request->only('username', 'password');

    try {
        // attempt to verify the credentials and create a token for the user
        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
    } catch (JWTException $e) {
        // something went wrong whilst attempting to encode the token
        return response()->json(['error' => 'could_not_create_token'], 500);
    }

    // all good so return the token
    return response()->json([
      'id' => $request->user()->id,
      'token' => $token
    ]);
  }
}
