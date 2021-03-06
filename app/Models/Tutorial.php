<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function Comments()
  {
    return $this->hasMany('App\Models\Comment');
  }
}
