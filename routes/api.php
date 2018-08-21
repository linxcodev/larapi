<?php

Route::middleware(['api'])->group(function () {
  Route::post('auth/signup', 'AuthController@signup');
  Route::post('auth/signin', 'AuthController@signin');

    Route::middleware(['jwt.auth'])->group(function () {
      Route::get('profile', 'UserController@show');
    });
});
