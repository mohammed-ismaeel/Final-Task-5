<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Comment::class);
        $comments = Comment::all();
        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $this->authorize('create', Comment::class);
        if(!Auth::check()){
            return response()->json([
                'message' => "unauthorize"
            ],403);
        }

        $request->validate([
            'comment' => 'required|string',
        ]);


          $comment = Comment::create([
            "comment" => $request->input("comment"),
            "user_id" => Auth::id(),
            "post_id" => $post->id,
        ]);
        return response()->json([
            "message" => "comment added",
            "comment" => $comment ,
        ], 201);
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Comment $comment)
    // {
    //     //
    // }

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
        return response()->json([
            "message" => "comment updated",
            "comment" => $comment,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete',$comment);
        $comment->delete();

        return response()->json([
            "message" => "comment deleted successfully"
        ],201);
    }
}
