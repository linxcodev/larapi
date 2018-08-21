<?php

Route::middleware(['api'])->group(function () {
  Route::post('auth/signup', 'AuthController@signup');
  Route::post('auth/signin', 'AuthController@signin');
});
