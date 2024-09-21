@extends('layouts.app')

@section('title', 'Edit Tag')

@section('logout')
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="font-semibold text-lg border border-black rounded-md px-2 hover:bg-slate-700 hover:text-white">Logout</button>
    </form>
@endsection

@section('hero-content')
    <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST" enctype="multipart/form-data"
        class="flex flex-col mx-auto items-center text-slate-950 mb-12 mt-0 ">
        @csrf
        @method('PUT')

        <h1 class=" text-3xl text-white border-b">Edit Tag</h1>
        <div class="input my-5 flex flex-col gap-2">
            <label for="title" class="text-xl text-white">Title :</label>
            <input type="text" id="title" name="title" value="{{ $tag->title }}"
                class="border-solid border-black border w-80 h-10 outline-none pl-3 rounded-lg">
        </div>

        <div class="buttons flex gap-4">
            <a href="{{ route('admin.tags.index') }}" class="bg-neutral-100 text-xl px-4 py-1 rounded-md">Back</a>
            <input type="submit" value="Send" class=" bg-neutral-100 text-xl px-4 py-1 rounded-md">
        </div>
    </form>
@endsection
