<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - {{ config('app.name', 'SuratUndangan') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full">
    <div class="flex h-full">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-cream-dark shadow-sm hidden lg:flex lg:flex-col">
            <div class="flex items-center gap-2 px-6 py-5 border-b border-cream-dark">
                <span class="text-xl font-serif font-bold text-gold">Admin Panel</span>
            </div>
            <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-gold text-white' : 'text-gray-700 hover:bg-cream' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.wedding.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.wedding.*') ? 'bg-gold text-white' : 'text-gray-700 hover:bg-cream' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Konfigurasi
                </a>
                <a href="{{ route('admin.events.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.events.*') ? 'bg-gold text-white' : 'text-gray-700 hover:bg-cream' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Event
                </a>
                <a href="{{ route('admin.stories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.stories.*') ? 'bg-gold text-white' : 'text-gray-700 hover:bg-cream' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    Love Story
                </a>
                <a href="{{ route('admin.galleries.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.galleries.*') ? 'bg-gold text-white' : 'text-gray-700 hover:bg-cream' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Gallery
                </a>
                <a href="{{ route('admin.gifts.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.gifts.*') ? 'bg-gold text-white' : 'text-gray-700 hover:bg-cream' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 1114.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                    Wedding Gift
                </a>
                <a href="{{ route('admin.wishes.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.wishes.*') ? 'bg-gold text-white' : 'text-gray-700 hover:bg-cream' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 16z"/></svg>
                    Ucapan
                </a>
                <hr class="my-3 border-cream-dark">
                <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-700 hover:bg-cream transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Preview Undangan
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Mobile header -->
        <div class="lg:hidden fixed top-0 inset-x-0 z-30 bg-white border-b border-cream-dark px-4 py-3 flex items-center justify-between">
            <span class="text-lg font-serif font-bold text-gold">Admin</span>
            <button id="mobileMenuBtn" class="text-gray-700 p-1" onclick="document.getElementById('mobileSidebar').classList.toggle('hidden')">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>

        <!-- Mobile sidebar (hidden by default) -->
        <div id="mobileSidebar" class="lg:hidden fixed inset-0 z-50 hidden">
            <div class="fixed inset-0 bg-black/50" onclick="document.getElementById('mobileSidebar').classList.add('hidden')"></div>
            <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg overflow-y-auto">
                <div class="flex items-center justify-between px-6 py-5 border-b border-cream-dark">
                    <span class="text-xl font-serif font-bold text-gold">Admin</span>
                    <button onclick="document.getElementById('mobileSidebar').classList.add('hidden')" class="text-gray-500">&times;</button>
                </div>
                <nav class="px-4 py-4 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-gold text-white' : 'text-gray-700' }}">Dashboard</a>
                    <a href="{{ route('admin.wedding.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.wedding.*') ? 'bg-gold text-white' : 'text-gray-700' }}">Konfigurasi</a>
                    <a href="{{ route('admin.events.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.events.*') ? 'bg-gold text-white' : 'text-gray-700' }}">Event</a>
                    <a href="{{ route('admin.stories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.stories.*') ? 'bg-gold text-white' : 'text-gray-700' }}">Love Story</a>
                    <a href="{{ route('admin.galleries.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.galleries.*') ? 'bg-gold text-white' : 'text-gray-700' }}">Gallery</a>
                    <a href="{{ route('admin.gifts.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.gifts.*') ? 'bg-gold text-white' : 'text-gray-700' }}">Wedding Gift</a>
                    <a href="{{ route('admin.wishes.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.wishes.*') ? 'bg-gold text-white' : 'text-gray-700' }}">Ucapan</a>
                    <hr class="my-3">
                    <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-700">Preview</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-red-600">Logout</button>
                    </form>
                </nav>
            </aside>
        </div>

        <!-- Main content -->
        <main class="flex-1 lg:pl-64 pt-14 lg:pt-0">
            <div class="p-6 lg:p-8">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Toast container -->
    <div id="toastContainer" class="fixed bottom-6 right-6 z-50 space-y-3"></div>

    @stack('scripts')
</body>
</html>
