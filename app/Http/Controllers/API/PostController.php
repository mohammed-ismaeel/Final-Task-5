<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    //   public function __construct()
    // {
    //     // Apply the Sanctum auth middleware
    //     $this->middleware('auth:sanctum');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        $this->authorize('create', Post::class);
    } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
        \Log::error('Unauthorized access attempt: ' . $e->getMessage());
        return response()->json(['message' => 'Unauthorized'], 403);
    }

        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'tags_id' => 'required|array|exists:tags,id',
        ]);

        $imageName = null;
        if($request->hasFile('image')){
            $image = $request->file("image");
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

            $post=Post::create([
            "title" => $request->input("title"),
            "description" => $request->input("description"),
            "image" => $imageName,
            "user_id" => Auth::id(),
            "category_id" => $request->input("category_id"),
        ]);
        $post->tags()->attach($request->input("tags_id"));
        return response()->json([
            "message" => "Post added ",
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // $this->authorize('update',$post);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'tags_id' => 'required|array|exists:tags,id',
        ]);


        $imageName=$post->image;
        if($request->hasFile('image')){
            $image = $request->file("image");
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        // try{
        $post->update([
            "title" => $request->input("title"),
            "description" => $request->input("description"),
            "image" => $imageName,
            "category_id" => $request->input("category_id"),
        ]);

        $post->tags()->sync($request->input("tags_id"));

        return response()->json([
            "message" => "Post updated",
            "post" => $post,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);

        if($post->image){
            Storage::delete(public_path('images/' . $post->image));
        }

        $post->delete();
        return response()->json([
            "message" => "post deleted successfully"
        ],201);
    }
}
