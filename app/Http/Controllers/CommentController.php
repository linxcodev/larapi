<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function store(Request $request, $tut_id)
  {
    $request->validate(['body' => 'required']);

    $comment = $request->user()->comments()->create([
      'body' => $request->json('body'),
      'tutorial_id' => $tut_id
    ]);

    return $comment;
  }
}
