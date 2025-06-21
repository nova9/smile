<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('storage/assets/logo.svg') }}" type="image/svg+xml">

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#31881C">


    <title>{{ $title ?? config('app.name') }}</title>
</head>
<body>
@if (session('success'))
    <div class="toast">
        <div class="alert alert-success">
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

{{ $slot }}
</body>
</html>
