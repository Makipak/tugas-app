<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Absensi Kampus')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    {{-- Anda bisa memuat CSS Anda sendiri --}}
    @yield('styles')
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav class="bg-blue-600 p-4 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold">Aplikasi Absensi</a>
            <div>
                @auth
                    <span>Halo, {{ Auth::user()->username }} ({{ Auth::user()->role }})</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline-block ml-4">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-sm">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="text-white hover:underline ml-4">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 p-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">@yield('page_title')</h1>
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>