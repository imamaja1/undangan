<section id="location" class="py-20 md:py-32 section-bg overlay-dark" style="background-image: url('{{ asset('images/hero/location-bg.jpg') }}')">
    <div class="relative z-10 max-w-2xl mx-auto px-6">
        <h2 class="font-serif text-3xl md:text-4xl text-white font-light tracking-wide text-center text-shadow mb-16" data-reveal="fade">Venue</h2>
        <div class="glass rounded-2xl overflow-hidden shadow-2xl mb-8" data-reveal="up">
            <div class="aspect-[16/9]">
                @if($wedding->wedding_info['mapsEmbed'] ?? false)
                <iframe src="{{ $wedding->wedding_info['mapsEmbed'] }}" class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                @else
                <div class="w-full h-full bg-black/40 flex items-center justify-center">
                    <p class="text-white/30 font-sans text-xs">Peta belum tersedia</p>
                </div>
                @endif
            </div>
        </div>
        <div class="text-center" data-reveal="fade" data-reveal-delay="200">
            <p class="font-serif text-xl text-white font-light text-shadow">{{ $wedding->wedding_info['location'] ?? '' }}</p>
            <p class="text-white/50 text-sm mt-2 font-sans font-light">{{ $wedding->wedding_info['address'] ?? '' }}</p>
            @if($wedding->wedding_info['mapsLink'] ?? false)
            <a href="{{ $wedding->wedding_info['mapsLink'] }}" target="_blank" class="ghost-btn mt-6">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Open Maps
            </a>
            @endif
        </div>
    </div>
</section>
