<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Dream;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
      // $validated = $request->validate([
      //   'content' => 'required|string|max:255',
      // ]);
      $validated = $request->validate([
        'content' => 'required|string|max:255',
        'dream' => 'required|exists:dreams,id', // 验证 dream 参数存在于 dreams 表中
      ]);

      //Log::info('Dream ID: ' . $dream->id);
      //Log::info('User ID: ' . $request->user()->id);
      //Log::info('Content: ' . $validated['content']);

      // $comment = new Comment([
      //   'content' => $validated['content'],
      //   'user_id' => $request->user()->id,
      //   'dream_id' => 2
      // ]);

      // $comment = new Comment();
      // $comment->content = $validated['content'];
      // $comment->dream_id = $request->dream_id;//??
      // $comment->user_id = $request->user()->id;
      // $comment->save();

      //$dream->comments()->save($comment);

      $comment = Comment::create([
        'content' => $validated['content'],
        'user_id' => $request->user()->id,
        'dream_id' => $validated['dream'], // 使用传递的 dream 参数作为梦想的 ID
      ]);
     
      return redirect(route('dreams.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
