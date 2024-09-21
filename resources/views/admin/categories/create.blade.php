@extends('layouts.app')

@section('title', 'Add Category')

@section('logout')
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="font-semibold text-lg border border-black rounded-md px-2 hover:bg-slate-700 hover:text-white">Logout</button>
    </form>
@endsection

@section('hero-content')
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data"
        class="flex flex-col mx-auto items-center text-slate-950 mb-12 mt-0 ">
        @csrf
        <h1 class=" text-3xl text-white border-b">Add Category</h1>
        <div class="input my-5 flex flex-col gap-2">
            <label for="title" class="text-xl text-white">Title :</label>
            <input type="text" id="title" name="title"
                class="border-solid border-black border w-80 h-10 outline-none pl-3 rounded-lg">
        </div>

        <div class="input my-5">
            <label for="image" class="bg-blue-600 px-4 py-2 font-semibold cursor-pointer">Add Image</label>
            <input type="file" name="image" id="image" class="invisible">
        </div>
        <div class="buttons flex gap-4">
            <a href="{{ route('admin.categories.index') }}" class="bg-neutral-100 text-xl px-4 py-1 rounded-md">Back</a>
            <input type="submit" value="Send" class=" bg-neutral-100 text-xl px-4 py-1 rounded-md cursor-pointer">
        </div>
    </form>
@endsection
