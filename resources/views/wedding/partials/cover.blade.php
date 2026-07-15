<div id="coverSection" class="fixed inset-0 z-50 flex flex-col items-center justify-center section-bg overlay-dark min-h-[100dvh]" style="background-image: url('{{ asset('images/hero/cover-bg.jpg') }}')">
    {{-- Subtle top decoration --}}
    <div class="absolute top-8 md:top-12 left-0 right-0 z-10 text-center">
        <p class="font-serif text-3xl md:text-5xl text-white/15 font-light tracking-widest italic">
            {{ $wedding->quotes['bismillah'] ?? 'بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ' }}
        </p>
    </div>

    {{-- Center: All content in glass card --}}
    <div class="relative z-10 text-center px-6 w-full max-w-lg">
        <div class="glass rounded-3xl py-10 px-6 md:py-14 md:px-10 shadow-2xl">
            <p class="text-white/30 font-sans text-[9px] tracking-[0.5em] uppercase mb-8">Wedding Invitation</p>
            <h1 class="font-serif text-4xl md:text-7xl text-white font-light mb-3 leading-tight text-shadow-lg">
                {{ $wedding->couple['groomName'] ?? '' }}
            </h1>
            <span class="block font-sans text-2xl md:text-3xl font-extralight my-4 text-white/30">&</span>
            <h1 class="font-serif text-4xl md:text-7xl text-white font-light mb-6 leading-tight text-shadow-lg">
                {{ $wedding->couple['brideName'] ?? '' }}
            </h1>
            <div class="w-10 h-px bg-white/20 mx-auto my-6"></div>
            <p class="text-white/50 font-sans text-sm tracking-[0.3em] uppercase">{{ $wedding->wedding_info['dateFormatted'] ?? '' }}</p>
        </div>
    </div>

    {{-- Bottom: Guest + Button --}}
    <div class="absolute bottom-8 md:bottom-12 left-0 right-0 z-10 text-center px-6">
        <p class="text-white/40 text-xs mb-5">
            Kepada Yth. <span class="text-white/80 font-medium" id="guestName">{{ $guestName }}</span>
        </p>
        <button id="openInvitationBtn" onclick="openInvitation()" class="ghost-btn px-12 py-3.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Buka Undangan
        </button>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 z-10">
        <svg class="scroll-indicator w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
    </div>
</div>

<audio id="bgMusic" loop preload="auto">
    <source src="{{ asset('audio/wedding.mp3') }}" type="audio/mpeg">
</audio>

<button id="musicControl" class="fixed bottom-6 right-6 z-40 w-11 h-11 glass rounded-full items-center justify-center hidden text-white shadow-lg hover:scale-110 transition-all duration-300" title="Music">
    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M17.95 6.05a8 8 0 010 11.9M6.5 8.8l5.5-4v14.4l-5.5-4H4a1 1 0 01-1-1v-4.4a1 1 0 011-1h2.5z"/></svg>
</button>
