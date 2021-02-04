<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $settings->get('site_title') ?? 'Laravel Mark' }}</title>

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/typography@0.3.1/dist/typography.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @stack('styles')
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family={{ $settings->has('font') ? Str::of($settings->get('font'))->replace(' ', '+') : 'Space+Grotesk' }}:wght@400;500;600;700&display=swap">

        <style>
            html { scroll-behavior: smooth; }
            [x-cloak] { display: none; }
        </style>

        <!-- Scripts -->
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
        <script src="{{ asset('js/app.js') }}" defer></script>

        @stack('scripts')
    </head>
    <body class="antialiased" style="font-family: {{ $settings->has('font') ? $settings->get('font') : 'Space Grotesk, sans-serif' }}">
        <div class="text-gray-800">
            {{ $slot }}
        </div>

        <x-toastr />
    </body>
</html>
