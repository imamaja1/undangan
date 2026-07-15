@extends('layouts.admin')

@section('content')
<div>
    <h1 class="text-2xl font-serif font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-500 text-sm mt-1">Selamat datang di panel admin undangan pernikahan. Kelola semua konten undangan dari sini.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        <a href="{{ route('admin.wedding.edit') }}" class="bg-white rounded-xl shadow-sm border border-cream-dark p-6 hover:shadow-md transition-shadow group">
            <div class="w-12 h-12 bg-gold/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-gold group-hover:text-white transition-colors">
                <svg class="w-6 h-6 text-gold group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="font-semibold text-gray-800 text-lg">Konfigurasi</h3>
            <p class="text-sm text-gray-500 mt-1">Edit data mempelai, tanggal, quotes, dan pengaturan sections</p>
        </a>

        <a href="{{ route('admin.events.index') }}" class="bg-white rounded-xl shadow-sm border border-cream-dark p-6 hover:shadow-md transition-shadow group">
            <div class="w-12 h-12 bg-gold/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-gold group-hover:text-white transition-colors">
                <svg class="w-6 h-6 text-gold group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="font-semibold text-gray-800 text-lg">Event</h3>
            <p class="text-sm text-gray-500 mt-1">Atur jadwal akad nikah dan resepsi</p>
        </a>

        <a href="{{ route('admin.stories.index') }}" class="bg-white rounded-xl shadow-sm border border-cream-dark p-6 hover:shadow-md transition-shadow group">
            <div class="w-12 h-12 bg-gold/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-gold group-hover:text-white transition-colors">
                <svg class="w-6 h-6 text-gold group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </div>
            <h3 class="font-semibold text-gray-800 text-lg">Love Story</h3>
            <p class="text-sm text-gray-500 mt-1">Kelola {{ $wedding->stories_count ?? 0 }} cerita perjalanan cinta</p>
        </a>

        <a href="{{ route('admin.galleries.index') }}" class="bg-white rounded-xl shadow-sm border border-cream-dark p-6 hover:shadow-md transition-shadow group">
            <div class="w-12 h-12 bg-gold/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-gold group-hover:text-white transition-colors">
                <svg class="w-6 h-6 text-gold group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="font-semibold text-gray-800 text-lg">Gallery</h3>
            <p class="text-sm text-gray-500 mt-1">Upload dan atur {{ $wedding->galleries_count ?? 0 }} foto prewedding</p>
        </a>

        <a href="{{ route('admin.gifts.index') }}" class="bg-white rounded-xl shadow-sm border border-cream-dark p-6 hover:shadow-md transition-shadow group">
            <div class="w-12 h-12 bg-gold/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-gold group-hover:text-white transition-colors">
                <svg class="w-6 h-6 text-gold group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 1114.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
            </div>
            <h3 class="font-semibold text-gray-800 text-lg">Wedding Gift</h3>
            <p class="text-sm text-gray-500 mt-1">Atur QRIS dan rekening bank</p>
        </a>

        <a href="{{ route('admin.wishes.index') }}" class="bg-white rounded-xl shadow-sm border border-cream-dark p-6 hover:shadow-md transition-shadow group">
            <div class="w-12 h-12 bg-gold/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-gold group-hover:text-white transition-colors">
                <svg class="w-6 h-6 text-gold group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
            </div>
            <h3 class="font-semibold text-gray-800 text-lg">Ucapan</h3>
            <p class="text-sm text-gray-500 mt-1">{{ $wishCount ?? 0 }} ucapan dari tamu</p>
        </a>
    </div>

    @if(isset($wedding))
    <div class="mt-10 bg-white rounded-xl shadow-sm border border-cream-dark p-6">
        <h2 class="font-serif font-bold text-lg text-gray-800 mb-3">Ringkasan Undangan</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
            <div><span class="text-gray-500">Mempelai:</span> <span class="font-medium">{{ $wedding->couple['groomShort'] ?? '?' }} & {{ $wedding->couple['brideShort'] ?? '?' }}</span></div>
            <div><span class="text-gray-500">Tanggal:</span> <span class="font-medium">{{ $wedding->wedding_info['dateFormatted'] ?? '-' }}</span></div>
            <div><span class="text-gray-500">Lokasi:</span> <span class="font-medium">{{ $wedding->wedding_info['location'] ?? '-' }}</span></div>
        </div>
    </div>
    @endif
</div>
@endsection
