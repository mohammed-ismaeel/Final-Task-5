<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',Post::class);

        $posts = Post::all();
        return view("posts.index")->with("posts",$posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        $categories = Category::all();
        $tags = Tag::all();
        return view("posts.create")->with("categories",$categories)->with("tags",$tags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
            'tags_id' => 'required|array',
        ]);

        if($request->hasFile('image')){
            $image = $request->file("image");
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        $post=Post::create([
            "title" => $request->input("title"),
            "description" => $request->input("description"),
            "image" => $imageName,
            "user_id" => Auth::user()->id,
            "category_id" => $request->input("category_id"),
        ]);

        $post->tags()->attach($request->input("tags_id"));

        return redirect()->route('post.index')->with("success", "Post add successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);

        $userImageName = Auth::user()->image;
        $userName = Auth::user()->name;
        $category = $post->category;
        $tags = $post->tags->pluck('title')->toArray();
        $comments = $post->comments->pluck('comment')->toArray();
        return view("posts.show")->with("post",$post)->with("userImageName",$userImageName)->with("userName",$userName)->with("category",$category)->with("tags",$tags)->with("comments",$comments);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();
        $tags =Tag::all();
        $selectedCategory = $post->category_id;
        $selectedTag = $post->tags->pluck("id")->toArray();

        return view("posts.edit")->with("post",$post)->with("categories",$categories)->with("selectedCategory",$selectedCategory)->with("tags",$tags)->with("selectedTag",$selectedTag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update',$post);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
            'tags_id' => 'required|array',
        ]);


        $imageName=$post->image;
        if($request->hasFile('image')){
            $image = $request->file("image");
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        $post->update([
            "title" => $request->input("title"),
            "description" => $request->input("description"),
            "image" => $imageName,
            "category_id" => $request->input("category_id"),
        ]);

        $post->tags()->sync($request->input("tags_id"));

        return redirect()->route('post.index')->with("success", "post edit successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);

        $post->delete();
        return redirect()->route('post.index')->with("success", "post deleted successfully");
    }
}
