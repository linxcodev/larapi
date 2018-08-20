<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
      'password' => $request->json('password')
    ]);

    return $user;
  }
}
