<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $wedding->couple['groomShort'] ?? '' }} & {{ $wedding->couple['brideShort'] ?? '' }} - Wedding Invitation</title>
    <meta name="description" content="Undangan Pernikahan {{ $wedding->couple['groomName'] ?? '' }} & {{ $wedding->couple['brideName'] ?? '' }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        // Mencegah browser mengingat posisi scroll saat di-refresh
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }
        window.scrollTo(0, 0);
    </script>
</head>
<body class="wedding-theme bg-warm-dark text-white font-sans overflow-x-hidden antialiased">

    @yield('content')

    @stack('scripts')
</body>
</html>
