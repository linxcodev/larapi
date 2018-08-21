<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
  public function index()
  {
    return Tutorial::all();
  }

  public function show($id)
  {
    $tutorial = Tutorial::find($id);

    if (!$tutorial) {
      $tutorial = response()->json([
        'error' => 'id tutorial tidak di temukan'
      ], 404);
    }
    
    return $tutorial;
  }

  public function store(Request $request)
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
