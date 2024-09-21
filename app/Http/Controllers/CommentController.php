<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Console\Migrations\RefreshCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
    public function store(Request $request , Post $post)
    {
        $this->authorize('create', Comment::class);

        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = Comment::create([
            "comment" => $request->input("comment"),
            "user_id" => Auth::id(),
            "post_id" => $post->id,
        ]);

        return redirect()->route('post.show', $post->id)->with(' add comment success');
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
        $this->authorize('update',$comment);
        return view('comments.edit')->with('comment',$comment);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update',$comment);

        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment->update([
            "comment" => $request->input("comment"),
        ]);

        return redirect()->route('post.show', $comment->post_id)->with('message',' Comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete',$comment);
        $comment->delete();

        return redirect()->route('post.show', $comment->post->id)->with(' add comment success');

    }
}
