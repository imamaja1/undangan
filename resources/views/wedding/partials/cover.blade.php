<div id="coverSection" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-cream transition-transform duration-700 ease-in-out">
    <div class="text-center px-6">
        <p class="text-gold font-script text-4xl md:text-5xl mb-4">
            {{ $wedding->quotes['bismillah'] ?? 'بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ' }}
        </p>
        <h1 class="text-3xl md:text-5xl font-serif font-bold text-gray-800 mb-2">
            {{ $wedding->couple['groomShort'] ?? '' }} & {{ $wedding->couple['brideShort'] ?? '' }}
        </h1>
        <p class="text-gray-500 text-lg mb-8">{{ $wedding->wedding_info['dateFormatted'] ?? '' }}</p>
        <p class="text-gray-600 mb-8 text-sm max-w-md mx-auto">
            Kepada Yth.<br>
            <span class="font-semibold text-lg" id="guestName">{{ $guestName }}</span>
        </p>
        <button id="openInvitationBtn" onclick="openInvitation()" class="px-10 py-3 bg-gold hover:bg-gold-dark text-white rounded-full font-medium transition-colors shadow-lg text-lg">
            Buka Undangan
        </button>
    </div>
</div>

<audio id="bgMusic" loop preload="auto">
    <source src="{{ asset('audio/wedding.mp3') }}" type="audio/mpeg">
</audio>

<button id="musicControl" class="fixed bottom-6 right-6 z-40 w-12 h-12 bg-gold hover:bg-gold-dark text-white rounded-full shadow-lg items-center justify-center hidden transition-colors" title="Music">
    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M17.95 6.05a8 8 0 010 11.9M6.5 8.8l5.5-4v14.4l-5.5-4H4a1 1 0 01-1-1v-4.4a1 1 0 011-1h2.5z"/>
    </svg>
</button>
