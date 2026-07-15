<footer id="footer" class="py-16 bg-gray-900 text-white text-center">
    <div class="max-w-2xl mx-auto px-6">
        <p class="font-script text-3xl md:text-4xl text-gold mb-6" data-reveal="fade">
            {{ $wedding->quotes['footerClosing'] ?? 'Wassalamu\'alaikum Wr. Wb.' }}
        </p>
        <p class="text-gray-400 mb-8" data-reveal="up" data-reveal-delay="200">{{ $wedding->quotes['closingText'] ?? '' }}</p>
        <p class="font-serif text-2xl md:text-3xl font-bold text-gold mb-2" data-reveal="scale" data-reveal-delay="400">
            {{ $wedding->couple['groomShort'] ?? '' }} & {{ $wedding->couple['brideShort'] ?? '' }}
        </p>
        <p class="text-gray-500 text-sm mt-6" data-reveal="fade" data-reveal-delay="600">
            &copy; {{ date('Y') }} Wedding Invitation. Made with 
            <svg class="w-4 h-4 inline-block text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        </p>
    </div>
</footer>
