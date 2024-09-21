<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("admin", User::class);

        $tags = Tag::all();
        return view("admin.tags.index")->with("tags",$tags);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("admin", User::class);

        return view("admin.tags.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->authorize('admin', User::class);

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $tag = new Tag;
        $tag->create([
            "title" => $request->input("title"),
        ]);

        return redirect()->route('admin.tags.index')->with("success", "Tag add successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $this->authorize('admin', User::class);

        return view("admin.tags.edit")->with("tag",$tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {

        $this->authorize('admin', User::class);

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

         $tag->update([
            "title" => $request->input("title"),
        ]);

        return redirect()->route('admin.tags.index')->with("success", "Tag updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {

        $this->authorize('admin',User::class);
        $tag->delete();
        return redirect()->route('admin.tags.index')->with("success", "Tag deleted successfully");
    }
}
