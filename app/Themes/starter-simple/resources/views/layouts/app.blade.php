<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page->title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-slate-900 antialiased">
    @include('starter-simple::components.layout.header')

    <main class="mx-auto w-full max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    @include('starter-simple::components.layout.footer')
</body>
</html>
