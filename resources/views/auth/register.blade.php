@extends('layouts.app')

@section('title', 'Register')

@section('hero-content')

    <div class="hero-content">
        {{-- Register-Page --}}
        <h1 class="text-3xl font-bold">Register</h1>
        <div class="form flex justify-center items-center">
            {{-- Register Form --}}
            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col  text-left w-80 gap-4">
                @csrf
                {{-- input Name --}}
                <div class="input flex flex-col">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name"
                        class="text-slate-950 border-solid border-black border w-80 h-10 outline-none pl-3 rounded-lg"
                        required>
                </div>
                {{-- input Email --}}
                <div class="input flex flex-col">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email"
                        class="text-slate-950 border-solid border-black border w-80 h-10 outline-none pl-3 rounded-lg"
                        required>
                </div>
                {{-- input password --}}
                <div class="input flex flex-col">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password"
                        class="text-slate-950 border-solid border-black border w-80 h-10 outline-none pl-3 rounded-lg"
                        required>
                </div>
                {{-- input password-confirmation --}}
                <div class="input flex flex-col">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class=" text-slate-950 border-solid border-black border w-80 h-10 outline-none pl-3 rounded-lg"
                        required>
                </div>
                {{-- input add user-image --}}
                <div class="input my-2">
                    <label for="image" class="bg-blue-600 px-4 py-2 font-semibold cursor-pointer">Add your Image</label>
                    <input type="file" name="image" id="image" class="invisible">
                </div>
                {{-- button --}}
                <button type="submit"
                    class="bg-neutral-100 text-slate-900 font-semibold text-xl px-4 py-1 rounded-md w-44 mx-auto">Register</button>
                <p class="text-center">Already have an account? <a href="{{ route('login') }}"
                        class="underline hover:text-sky-500">Login</a>
                </p>
            </form>
        </div>
    </div>

@endsection
