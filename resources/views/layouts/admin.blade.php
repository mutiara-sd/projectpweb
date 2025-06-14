<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-blue-800 text-white px-6 py-4 flex justify-between items-center">
        <div class="text-xl font-bold">Admin MakanYuk!</div>
        <div>
            <span class="mr-4">Halo, {{ Auth::user()->name }}</span>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="underline text-sm hover:text-gray-300">Logout</a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                @csrf
            </form>
        </div>
    </nav>

    {{-- Wrapper: Sidebar + Content --}}
    <div class="flex">

        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-900 text-white min-h-screen p-6">
            <ul class="space-y-4">
                <li><a href="{{ route('admin.dashboard') }}" class="hover:text-yellow-400">Dashboard</a></li>
                <li><a href="{{ route('admin.user') }}" class="hover:text-yellow-400">Data User</a></li>
                <li><a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="hover:text-yellow-400">Logout</a></li>
            </ul>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>

    {{-- Footer --}}
    <footer class="text-center text-gray-500 text-sm py-4">
        &copy; MakanYuk {{ now()->year }}
    </footer>

</body>
</html>
