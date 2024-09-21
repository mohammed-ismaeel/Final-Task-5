@extends('layouts.app')

@section('title', 'Tags')

@section('logout')
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="font-semibold text-lg border border-black rounded-md px-2 hover:bg-slate-700 hover:text-white">Logout</button>
    </form>
@endsection

@section('hero-content')
    <h1 class="font-semibold text-2xl pb-3">All Tags</h1>
    <a href="{{ route('admin.tags.create') }}" class="bg-sky-700 px-4 py-2 text-white rounded-lg">Add New Tag +</a>
    <div class="manage-tags flex justify-center items-center mt-10">
        <table class="w-6/12 text-left border border-solid border-white">
            <thead class="border border-solid border-white">
                <th class="border border-solid border-white pl-2 ">Id</th>
                <th class="border border-solid border-white pl-2">Title</th>
                <th class="border border-solid border-white pl-2">Actions</th>
            </thead>
            <tbody class="border border-solid border-white">
                @foreach ($tags as $tag)
                    <tr class="border border-solid border-white">
                        <td class="border border-solid border-white pl-2 py-3">{{ $tag->id }}</td>
                        <td class="border border-solid border-white pl-2 py-3">{{ $tag->title }}</td>
                        <td class=" border-white pl-2 py-3 flex gap-x-6 items-center justify-center">
                            <a href="{{ route('admin.tags.edit', $tag->id) }}"
                                class="bg-sky-600 px-6 py-2 rounded-sm">Edit</a>
                            <form action="{{ route('admin.tags.delete', $tag->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="bg-red-700 px-4 py-2 rounded-sm cursor-pointer">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
