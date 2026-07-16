<div id="coverSection" class="fixed inset-0 z-50 flex flex-col items-center justify-center section-bg overlay-warm-dark min-h-[100dvh] overflow-y-auto" style="background-image: url('{{ asset('images/hero/cover-bg.jpg') }}?v={{ file_exists(public_path('images/hero/cover-bg.jpg')) ? filemtime(public_path('images/hero/cover-bg.jpg')) : time() }}')">
    {{-- Particles --}}
    <div class="particle-container" id="coverParticles"></div>

    {{-- Top: Bismillah --}}
    <div class="relative z-10 text-center shrink-0 mt-12 md:mt-16 mb-auto">
        <p class="font-serif text-2xl md:text-4xl text-champagne/30 font-normal tracking-widest italic">
            {{ $wedding->quotes['bismillah'] ?? 'بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ' }}
        </p>
    </div>

    {{-- Center: Glass card --}}
    <div class="relative z-10 text-center px-6 w-full max-w-md shrink-0 py-8">
        <div class="glass-rose rounded-3xl py-10 px-6 md:py-14 md:px-10">
            <p class="text-rose-base/50 font-sans text-[9px] tracking-[0.6em] uppercase mb-8 md:mb-10">Wedding Invitation</p>
            <h1 class="font-serif text-4xl md:text-5xl text-white font-normal mb-2 leading-tight text-shadow-lg">
                {{ $wedding->couple['groomName'] ?? '' }}
            </h1>
            <span class="block font-script text-3xl md:text-4xl text-rose-base/60 my-3 md:my-4">&</span>
            <h1 class="font-serif text-4xl md:text-5xl text-white font-normal mb-6 leading-tight text-shadow-lg">
                {{ $wedding->couple['brideName'] ?? '' }}
            </h1>
            <div class="divider-ornament my-6 md:my-8">
                <div class="divider-ornament-icon"></div>
            </div>
            <p class="text-champagne/60 font-sans text-xs md:text-sm tracking-[0.3em] uppercase">{{ $wedding->wedding_info['dateFormatted'] ?? '' }}</p>
        </div>
    </div>

    {{-- Bottom: Guest + Button --}}
    <div class="relative z-10 text-center px-6 shrink-0 mt-auto mb-12 md:mb-16">
        <p class="text-champagne/40 text-xs mb-4 md:mb-6">
            Kepada Yth. <span class="text-champagne/80 font-medium" id="guestName">{{ $guestName }}</span>
        </p>
        <button id="openInvitationBtn" onclick="openInvitation()" class="ghost-btn px-10 md:px-12 py-3 md:py-3.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Buka Undangan
        </button>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-2 left-1/2 -translate-x-1/2 z-10 hidden" id="scrollHint">
        <svg class="scroll-indicator w-4 h-4 text-rose-base/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
    </div>
</div>

<audio id="bgMusic" loop preload="auto">
    <source src="{{ asset('audio/wedding.mp3') }}?v={{ file_exists(public_path('audio/wedding.mp3')) ? filemtime(public_path('audio/wedding.mp3')) : time() }}" type="audio/mpeg">
</audio>

<button id="musicControl" class="fixed bottom-6 right-6 z-40 w-11 h-11 glass rounded-full items-center justify-center hidden text-white shadow-lg hover:scale-110 transition-all duration-300" title="Music">
    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M17.95 6.05a8 8 0 010 11.9M6.5 8.8l5.5-4v14.4l-5.5-4H4a1 1 0 01-1-1v-4.4a1 1 0 011-1h2.5z"/></svg>
</button>
