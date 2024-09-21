<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("admin", User::class);

        $categories = Category::all();
        return view("admin.categories.index")->with("categories",$categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("admin", User::class);

        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('admin', User::class);

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = new Category;
        $imageName=" ";
        if($request->hasFile('image')){
            $image = $request->file("image");
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        $category->create([
            "title" => $request->input("title"),
            "image" => $imageName,
        ]);

        return redirect()->route('admin.categories.index')->with("success", "Category and post add successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('admin', User::class);

        return view("admin.categories.edit")->with("category",$category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('admin', User::class);

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName=$category->image;
        if($request->hasFile('image')){
            $image = $request->file("image");
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }
        $category->update([
            "title" => $request->input("title"),
            "image" => $imageName,
        ]);

        return redirect()->route('admin.categories.index')->with("success", "Category updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('admin',User::class);
        $category->delete();
        return redirect()->route('admin.categories.index')->with("success", "category deleted successfully");
    }
}
