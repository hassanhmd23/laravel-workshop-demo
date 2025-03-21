<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Task Manager')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex text-gray-800">
@include('partials.sidebar')
<div class="flex-1 min-h-screen p-6">
    @include('partials.navbar')
    <main class="mt-4">
        @if(!request()->routeIs('dashboard'))
            <div class="container mx-auto p-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    @yield('content')
                </div>
            </div>
        @else
            @yield('content')
        @endif
    </main>
</div>
<script>
    window.Laravel = {!! json_encode([
        'user' => auth()->check() ? auth()->id() : null,
    ]) !!};
</script>
</body>
</html>
