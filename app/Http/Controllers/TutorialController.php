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

  public function update(Request $request, $id)
  {
    $request->validate([
      'title' => 'required|unique:tutorials',
      'body' => 'required'
    ]);

    $tutorial = Tutorial::find($id);

    if (!$tutorial) {
      return response()->json([
        'error' => 'tutorial tidak di temukan'
      ], 404);
    }

    // mengecek apakah user itu sendiri yang menghapus
    if ($request->user()->id != $tutorial->user_id) {
      return response()->json([
        'error' => 'tidak diijinkan'
      ], 403);
    }

    $tutorial->update([
      'title' => $request->json('title'),
      'slug' => str_slug($request->json('title')),
      'body' => $request->json('body')
    ]);

    return $tutorial;
  }

  public function destroy(Request $request, $id)
  {
    $tutorial = Tutorial::find($id);

    if (!$tutorial) {
      return response()->json([
        'error' => 'tutorial tidak di temukan'
      ], 404);
    }

    // mengecek apakah user itu sendiri yang menghapus
    if ($request->user()->id != $tutorial->user_id) {
      return response()->json([
        'error' => 'tidak diijinkan'
      ], 403);
    }

    $tutorial->delete();
    
    return response()->json([
      'success' => true,
      'message' => 'success menghapus'
    ], 200);
  }
}
