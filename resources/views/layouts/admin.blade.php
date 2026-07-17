<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — {{ config('app.name', 'SuratUndangan') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        button, 
        [type="button"], 
        [type="submit"], 
        [role="button"],
        .cursor-pointer {
            cursor: pointer !important;
        }
    </style>
</head>
<body class="h-full bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar — Filament style dark --}}
        <aside class="hidden lg:flex fixed inset-y-0 left-0 z-40 w-64 flex-col bg-gray-950 text-gray-300">
            {{-- Logo --}}
            <div class="flex items-center gap-3 px-6 h-16 border-b border-gray-800 shrink-0">
                <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <span class="text-sm font-semibold text-white tracking-wide">SuratUndangan</span>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">
                @php
                $menus = [
                    ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['route' => 'admin.wedding.edit', 'label' => 'Konfigurasi', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'],
                    ['route' => 'admin.events.index', 'label' => 'Event', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                    ['route' => 'admin.stories.index', 'label' => 'Love Story', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                    ['route' => 'admin.galleries.index', 'label' => 'Gallery', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                    ['route' => 'admin.gifts.index', 'label' => 'Wedding Gift', 'icon' => 'M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 1114.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7'],
                    ['route' => 'admin.wishes.index', 'label' => 'Ucapan', 'icon' => 'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z'],
                    ['route' => 'admin.assets.index', 'label' => 'Asset', 'icon' => 'M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13'],
                ];
                @endphp
                @foreach($menus as $menu)
                <a href="{{ route($menu['route']) }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm group transition-all duration-200 {{ request()->routeIs(str_replace('.index','.*',str_replace('.edit','.*',$menu['route']))) ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5 shrink-0 {{ request()->routeIs(str_replace('.index','.*',str_replace('.edit','.*',$menu['route']))) ? 'text-white' : 'text-gray-500 group-hover:text-gray-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $menu['icon'] }}"/></svg>
                    {{ $menu['label'] }}
                </a>
                @endforeach
            </nav>

            {{-- Footer --}}
            <div class="border-t border-gray-800 px-3 py-3 space-y-1 shrink-0">
                <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-gray-800/50 transition-all duration-200">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Preview
                </a>
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-400 hover:text-red-400 hover:bg-red-500/10 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main content --}}
        <div class="flex-1 flex flex-col lg:pl-64 h-screen overflow-y-auto">
            {{-- Top bar --}}
            <header class="sticky top-0 z-30 h-16 bg-white border-b border-gray-200 flex items-center px-6 gap-4 shrink-0">
                <button onclick="document.getElementById('mobileSidebar')?.classList.toggle('hidden')" class="lg:hidden text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div class="flex-1">
                    <h2 class="text-sm font-medium text-gray-700">
                        @php
                            $breadcrumbs = [
                                'admin.dashboard' => 'Dashboard',
                                'admin.wedding.edit' => 'Konfigurasi',
                                'admin.events.index' => 'Event',
                                'admin.stories.index' => 'Love Story',
                                'admin.galleries.index' => 'Gallery',
                                'admin.gifts.index' => 'Wedding Gift',
                                'admin.wishes.index' => 'Ucapan',
                                'admin.assets.index' => 'Asset',
                            ];
                        @endphp
                        {{ $breadcrumbs[request()->route()->getName()] ?? 'Admin' }}
                    </h2>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-500">{{ Auth::user()->name }}</span>
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 text-xs font-medium">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </header>

            {{-- Page content --}}
            <main class="flex-1 p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Mobile sidebar overlay --}}
    <div id="mobileSidebar" class="lg:hidden fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="document.getElementById('mobileSidebar').classList.add('hidden')"></div>
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-950 text-gray-300 flex flex-col shadow-2xl">
            <div class="flex items-center justify-between px-6 h-16 border-b border-gray-800 shrink-0">
                <span class="text-sm font-semibold text-white">SuratUndangan</span>
                <button onclick="document.getElementById('mobileSidebar').classList.add('hidden')" class="text-gray-400 hover:text-white text-xl">&times;</button>
            </div>
            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">
                @foreach($menus as $menu)
                <a href="{{ route($menu['route']) }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-gray-800/50 transition-all duration-200">{{ $menu['label'] }}</a>
                @endforeach
            </nav>
            <div class="border-t border-gray-800 px-3 py-3">
                <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-400">Preview</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-red-400">Logout</button>
                </form>
            </div>
        </aside>
    </div>

    {{-- Toast container --}}
    <div id="toastContainer" class="fixed bottom-6 right-6 z-50 space-y-3"></div>

    @stack('scripts')
</body>
</html>
