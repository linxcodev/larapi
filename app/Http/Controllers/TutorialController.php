<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutorialController extends Controller
{
  public function create(Request $request)
  {
    $request->validate([
      'title' => 'required|unique:tutorials',
      'body' => 'required'
    ]);

    return $request->user()->tutorials()->create([
      'title' => $request->json('title'),
      'slug' => str_slug($request->json('title')),
      'body' => $request->json('body')
    ]);
  }
}
