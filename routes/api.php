<?php

Route::middleware(['api'])->group(function () {
  Route::post('auth/signup', 'AuthController@signup');
  Route::post('auth/signin', 'AuthController@signin');
  Route::get('tutorial', 'TutorialController@index');
  Route::get('tutorial/{id}', 'TutorialController@show');

  Route::middleware(['jwt.auth'])->group(function () {
    Route::get('/profile', 'UserController@show');
    Route::post('/tutorial', 'TutorialController@store');
  });
});
