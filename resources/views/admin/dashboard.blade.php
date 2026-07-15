@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-sm text-gray-500 mt-0.5">Ringkasan undangan pernikahan Anda.</p>
    </div>

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $wedding->stories()->count() ?? 0 }}</p>
                <p class="text-xs text-gray-500">Love Story</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $wedding->galleries()->count() ?? 0 }}</p>
                <p class="text-xs text-gray-500">Foto Gallery</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 1114.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $wedding->gift->bankAccounts()->count() ?? 0 }}</p>
                <p class="text-xs text-gray-500">Rekening Bank</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-violet-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $wishCount ?? 0 }}</p>
                <p class="text-xs text-gray-500">Ucapan Tamu</p>
            </div>
        </div>
    </div>

    {{-- Quick links --}}
    <div>
        <h2 class="text-base font-semibold text-gray-900 mb-4">Menu Cepat</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
            @php
            $links = [
                ['route' => 'admin.wedding.edit', 'label' => 'Konfigurasi', 'color' => 'amber'],
                ['route' => 'admin.events.index', 'label' => 'Event', 'color' => 'blue'],
                ['route' => 'admin.stories.index', 'label' => 'Love Story', 'color' => 'rose'],
                ['route' => 'admin.galleries.index', 'label' => 'Gallery', 'color' => 'indigo'],
                ['route' => 'admin.gifts.index', 'label' => 'Wedding Gift', 'color' => 'emerald'],
                ['route' => 'admin.wishes.index', 'label' => 'Ucapan', 'color' => 'violet'],
                ['route' => 'admin.assets.index', 'label' => 'Asset', 'color' => 'cyan'],
            ];
            @endphp
            @foreach($links as $link)
            <a href="{{ route($link['route']) }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 hover:shadow-md hover:border-gray-300 transition-all duration-200 group">
                <p class="text-sm font-medium text-gray-800 group-hover:text-{{ $link['color'] }}-600 transition-colors">{{ $link['label'] }}</p>
                <p class="text-xs text-gray-400 mt-1 group-hover:text-{{ $link['color'] }}-500">Kelola &rarr;</p>
            </a>
            @endforeach
        </div>
    </div>

    @if(isset($wedding))
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-3">Info Undangan</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
            <div><span class="text-gray-500">Mempelai:</span> <span class="font-medium text-gray-800">{{ $wedding->couple['groomShort'] ?? '?' }} & {{ $wedding->couple['brideShort'] ?? '?' }}</span></div>
            <div><span class="text-gray-500">Tanggal:</span> <span class="font-medium text-gray-800">{{ $wedding->wedding_info['dateFormatted'] ?? '-' }}</span></div>
            <div><span class="text-gray-500">Lokasi:</span> <span class="font-medium text-gray-800">{{ $wedding->wedding_info['location'] ?? '-' }}</span></div>
        </div>
    </div>
    @endif
</div>
@endsection
