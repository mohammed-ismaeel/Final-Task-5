@extends('layouts.app')

@section('title', 'Add User')

@section('logout')
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="font-semibold text-lg border border-black rounded-md px-2 hover:bg-slate-700 hover:text-white">Logout</button>
    </form>
@endsection

@section('hero-content')
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data"
        class="flex flex-col mx-auto items-center text-slate-950 mb-12 mt-0 gap-3 ">
        @csrf
        <h1 class=" text-3xl text-white border-b">Add User</h1>
        <div class="input flex flex-col">
            <label for="name" class="text-white">Name:</label>
            <input type="text" id="name" name="name"
                class="text-slate-950 border-solid border-black border w-80 h-10 outline-none pl-3 rounded-lg" required>
        </div>
        {{-- input Email --}}
        <div class="input flex flex-col">
            <label for="email" class="text-white">Email:</label>
            <input type="email" id="email" name="email"
                class="text-slate-950 border-solid border-black border w-80 h-10 outline-none pl-3 rounded-lg" required>
        </div>
        {{-- input password --}}
        <div class="input flex flex-col">
            <label for="password" class="text-white">Password:</label>
            <input type="password" id="password" name="password"
                class="text-slate-950 border-solid border-black border w-80 h-10 outline-none pl-3 rounded-lg" required>
        </div>
        {{-- input password-confirmation --}}
        <div class="input flex flex-col">
            <label for="password_confirmation" class="text-white">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class=" text-slate-950 border-solid border-black border w-80 h-10 outline-none pl-3 rounded-lg" required>
        </div>
        {{-- input add user-image --}}
        <div class="input my-2">
            <label for="image" class="bg-blue-600 px-4 py-2 font-semibold cursor-pointer">Add your Image</label>
            <input type="file" name="image" id="image" class="invisible">
        </div>

        <div class="buttons flex gap-4">
            <a href="{{ route('admin.categories.index') }}" class="bg-neutral-100 text-xl px-4 py-1 rounded-md">Back</a>
            <input type="submit" value="Send" class=" bg-neutral-100 text-xl px-4 py-1 rounded-md cursor-pointer">
        </div>
    </form>
@endsection
