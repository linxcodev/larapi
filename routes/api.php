<?php

Route::middleware(['api'])->group(function () {
  Route::post('auth/signup', 'AuthController@signup');
});
