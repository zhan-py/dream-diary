<?php

namespace App\Http\Controllers;

use App\Models\Dream;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
    public function toggle(Dream $dream): JsonResponse
    {
        $user = auth()->user();
        
        if ($dream->likes()->where('user_id', $user->id)->exists()) {
            $dream->likes()->detach($user->id);
            $isLiked = false;
        } else {
            $dream->likes()->attach($user->id);
            $isLiked = true;
        }
        
        $totalLikes = $dream->likes()->count();
        
        return response()->json([
            'is_liked' => $isLiked,
            'total_likes' => $totalLikes,
        ]);
    }

    public function check(Dream $dream): JsonResponse
    {
        $user = auth()->user();
        
        if ($dream->likes()->where('user_id', $user->id)->exists()) {
            $isLiked = true;
        } else {
            $isLiked = false;
        }

        return response()->json([
            'is_liked' => $isLiked,
        ]);
    }
    
    public function index(Dream $dream)
    {
      $totalLikes = $dream->likes->count();
      return response()->json(['total_upvotes' => $totalLikes ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        //
    }
}
