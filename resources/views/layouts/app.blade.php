<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/assets/style.css">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>

<body class="min-h-screen">
    <div class="blog-container w-full min-h-screen">
        <header class="w-full">
            <nav class="flex w-full mx-auto justify-between items-center h-16 bg-slate-100 text-black px-6">
                <div class="left flex gap-14 items-center">
                    <h2 class="text-black text-xl font-semibold">Blog Dashboard</h2>
                    @auth
                        @can('admin', App\Models\User::class)
                            <ul class="flex gap-8 text-base font-semibold">
                                <li class="hover:text-sky-400"> <a href="{{ route('dashboard') }}"
                                        class="text-base font-semibold border-b border-slate-900 hover:text-sky-400 hover:border-sky-200 px-3 py-2 block">ManageUsers</a>
                                </li>
                                <li class="hover:text-sky-400">
                                    <a href="{{ route('admin.categories.index') }}"
                                        class="text-base font-semibold border-b border-slate-900 hover:text-sky-400 hover:border-sky-200 px-3 py-2 block">ManageCategories</a>
                                </li>
                                <li class="hover:text-sky-400">
                                    <a href="{{ route('admin.tags.index') }}"
                                        class="text-base font-semibold border-b border-slate-900 hover:text-sky-400 hover:border-sky-200  px-3 py-2 block">ManageTags</a>
                                </li>
                            </ul>
                        @endcan
                    @endauth
                </div>
                <div class="right flex gap-5">
                    @yield('logout')
                </div>
            </nav>
            {{-- @ yields --}}
            <div class="hero text-center text-white py-14">
                @yield('main-title')
                @yield('read-update')
                @yield('hero-content')
            </div>
        </header>

        <main>
            <div class="content w-10/12 mx-auto">
                @yield('content')
            </div>
        </main>

        {{-- footer --}}
        <footer class="h-12 mx-auto flex items-center justify-between text-black bg-slate-100 px-9">
            <div class="left-footer">
                &copy; 2024 AIBlog.com
            </div>
            <div class="center-footer">
                <img src="/images/Ai-logo.png" alt="AiBLog Logo" class="w-10">
            </div>
            <h2 class="text-black text-lg font-semibold">Blog Dashboard</h2>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
</body>

</html>
