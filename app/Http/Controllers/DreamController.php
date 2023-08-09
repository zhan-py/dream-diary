<?php

namespace App\Http\Controllers;

use App\Models\Dream;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;


class DreamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return Inertia::render('Dreams/Index', [
        'dreams' => Dream::with([
            'user:id,name,avatar', 
            'comments.user:id,name,avatar',
            'likes'
        ])->withCount('likes')
        ->latest()
        ->get(),
      ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
      $validated = $request->validate([
        'message' => 'required|string|max:255',
      ]);

      $request->user()->dreams()->create($validated);

      return redirect(route('dreams.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Dream $dream)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dream $dream)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dream $dream): RedirectResponse
    {
      $this->authorize('update', $dream);
 
      $validated = $request->validate([
          'message' => 'required|string|max:255',
      ]);

      $dream->update($validated);

      return redirect(route('dreams.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dream $dream): RedirectResponse
    {
      $this->authorize('delete', $dream);
 
      $dream->delete();

      return redirect(route('dreams.index'));
    }
}
