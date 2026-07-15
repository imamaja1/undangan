<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $wedding->couple['groomShort'] ?? '' }} & {{ $wedding->couple['brideShort'] ?? '' }} - Wedding Invitation</title>
    <meta name="description" content="Undangan Pernikahan {{ $wedding->couple['groomName'] ?? '' }} & {{ $wedding->couple['brideName'] ?? '' }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-white font-sans overflow-x-hidden antialiased">

    @yield('content')

    @stack('scripts')
</body>
</html>
