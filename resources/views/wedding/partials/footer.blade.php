<footer id="footer" class="py-20 section-bg overlay-warm-dark" style="background-image: url('{{ asset('images/hero/footer-bg.jpg') }}')">
    <div class="particle-container" id="footerParticles"></div>
    <div class="relative z-10 max-w-lg mx-auto px-6 text-center">
        <p class="font-script text-3xl md:text-4xl text-rose-base/50 mb-6" data-reveal="fade">
            {{ $wedding->quotes['footerClosing'] ?? 'Wassalamu\'alaikum Wr. Wb.' }}
        </p>
        <p class="text-champagne/40 font-sans text-sm font-light mb-8" data-reveal="up" data-reveal-delay="200">{{ $wedding->quotes['closingText'] ?? '' }}</p>
        <div class="divider-ornament mb-8" data-reveal="fade" data-reveal-delay="300">
            <div class="divider-ornament-icon"></div>
        </div>
        <p class="font-serif text-2xl md:text-3xl text-rose-light font-light text-shadow" data-reveal="fade" data-reveal-delay="400">
            {{ $wedding->couple['groomShort'] ?? '' }} & {{ $wedding->couple['brideShort'] ?? '' }}
        </p>
        <p class="text-champagne/20 text-[10px] mt-10 font-sans tracking-[0.2em] uppercase" data-reveal="fade" data-reveal-delay="600">
            &copy; {{ date('Y') }} Wedding Invitation
        </p>
    </div>
</footer>
