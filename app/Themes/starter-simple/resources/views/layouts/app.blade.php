<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page->title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col antialiased">
    @include('starter-simple::components.layout.header')

    <main class="flex-1 mx-auto w-full max-w-5xl py-10">
        @yield('content')
    </main>

    @include('starter-simple::components.layout.footer')
</body>

</html>
