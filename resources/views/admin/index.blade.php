@extends('layouts.app')

@section('title', 'Blog')

@section('logout')
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="font-semibold text-lg border border-black rounded-md px-2 hover:bg-slate-700 hover:text-white">Logout</button>
    </form>
@endsection


@section('hero-content')
    <h1 class="font-semibold text-2xl pb-3">All Users</h1>
    <a href="{{ route('admin.users.create') }}" class="bg-sky-700 px-4 py-2 text-white rounded-lg">Add New User +</a>
    <div class="manageusers flex justify-center items-center mt-10">
        <div>
            <div>
                <table class="w-full text-left border border-solid border-white">
                    <thead class="border border-solid border-white">
                        <th class="border border-solid border-white px-2">Id</th>
                        <th class="border border-solid border-white px-2">userImage</th>
                        <th class="border border-solid border-white px-2">userName</th>
                        <th class="border border-solid border-white px-2">email</th>
                        <th class="border border-solid border-white px-2">Actions</th>
                    </thead>
                    <tbody class="border border-solid border-white">
                        @foreach ($users as $user)
                            @if ($user->is_block == 0)
                                <tr class="border border-solid border-white">
                                    <td class="border border-solid border-white px-2 py-3">{{ $user->id }}</td>
                                    <td class="border border-solid border-white pl-2 py-3"><img
                                            src="/images/{{ $user->image }}" alt="No Image" class="w-16 rounded-full"></td>
                                    <td class="border border-solid border-white pl-2 py-3">{{ $user->name }}</td>
                                    <td class="border border-solid border-white pl-2 py-3">{{ $user->email }}</td>
                                    <td class="px-4 py-2 flex gap-2 items-center justify-center h-24">
                                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete"
                                                class="bg-red-700 px-4 py-2 rounded-sm cursor-pointer">
                                        </form>
                                        <form action="{{ route('blockUser', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-sky-600 px-6 py-2 rounded-sm">Block</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-10">
                <h1 class="font-semibold text-2xl pb-3">Blocked Users</h1>
                <table class="w-full text-left border border-solid border-white">
                    <thead class="border border-solid border-white">
                        <th class="border border-solid border-white pl-2 ">Id</th>
                        <th class="border border-solid border-white pl-2">userImage</th>
                        <th class="border border-solid border-white pl-2">userName</th>
                        <th class="border border-solid border-white pl-2">email</th>
                        <th class="border border-solid border-white pl-2">Actions</th>
                    </thead>
                    <tbody class="border border-solid border-white">
                        @foreach ($users as $user)
                            @if ($user->is_block == 1)
                                <tr class="border border-solid border-white">
                                    <td class="border border-solid border-white pl-2 py-3">{{ $user->id }}</td>
                                    <td class="border border-solid border-white pl-2 py-3"><img
                                            src="/images/{{ $user->image }}" alt="No Image" class="w-16 rounded-full"></td>
                                    <td class="border border-solid border-white pl-2 py-3">{{ $user->name }}</td>
                                    <td class="border border-solid border-white pl-2 py-3">{{ $user->email }}</td>
                                    <td class="px-4 py-2 flex gap-2 items-center justify-center h-24">
                                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete"
                                                class="bg-red-700 px-4 py-2 rounded-sm cursor-pointer">
                                        </form>
                                        <form action="{{ route('unblockUser', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-sky-600 px-6 py-2 rounded-sm">unBlock</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
