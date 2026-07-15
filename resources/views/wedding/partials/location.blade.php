<section id="location" class="py-16 md:py-24 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-center font-serif text-3xl md:text-4xl font-bold text-gray-800 mb-4" data-reveal="fade">Lokasi</h2>
        <p class="text-center text-gold font-script text-2xl mb-12" data-reveal="scale">Venue</p>

        <div class="rounded-xl overflow-hidden shadow-lg mb-6 aspect-[16/9]" data-reveal="up">
            @if($wedding->wedding_info['mapsEmbed'] ?? false)
            <iframe src="{{ $wedding->wedding_info['mapsEmbed'] }}" class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            @else
            <div class="w-full h-full bg-cream-dark flex items-center justify-center">
                <p class="text-gray-500">Peta belum tersedia</p>
            </div>
            @endif
        </div>

        <div class="text-center" data-reveal="fade" data-reveal-delay="200">
            <p class="font-semibold text-lg">{{ $wedding->wedding_info['location'] ?? '' }}</p>
            <p class="text-gray-600 mt-1">{{ $wedding->wedding_info['address'] ?? '' }}</p>
            @if($wedding->wedding_info['mapsLink'] ?? false)
            <a href="{{ $wedding->wedding_info['mapsLink'] }}" target="_blank" class="inline-flex items-center gap-2 mt-4 px-6 py-2.5 bg-gold hover:bg-gold-dark text-white rounded-lg transition-colors font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Buka di Google Maps
            </a>
            @endif
        </div>
    </div>
</section>
