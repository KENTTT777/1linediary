<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', '1行日記') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- reset.css destyle -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css"/>

        <!-- Scripts -->
        @vite([
            'resources/css/app.css',
            'resources/css/index.css',
            'resources/js/app.js',
            'resources/js/post.js',
        ])
    </head>
    <body class="font-sans antialiased">
    
            @component('components.header', ['title' => $title ?? '1行日記'])
            @endcomponent

            <main>
                @yield('content')
            </main>

            @component('components.footer')
            @endcomponent
    </body>
</html>
