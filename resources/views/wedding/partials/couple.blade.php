<section id="couple" class="py-16 md:py-24 bg-cream">
    <div class="max-w-5xl mx-auto px-6">
        <h2 class="text-center font-serif text-3xl md:text-4xl font-bold text-gray-800 mb-4" data-reveal="fade">Mempelai</h2>
        <p class="text-center text-gold font-script text-2xl mb-12" data-reveal="scale">Bride & Groom</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
            <div class="text-center" data-reveal="left">
                <div class="w-48 h-48 md:w-56 md:h-56 mx-auto rounded-full overflow-hidden border-4 border-gold shadow-lg mb-6">
                    <img src="{{ asset('images/groom/groom.jpg') }}" alt="{{ $wedding->couple['groomName'] ?? '' }}" class="w-full h-full object-cover" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22300%22 height=%22300%22><rect fill=%22%23E9DFC8%22 width=%22300%22 height=%22300%22/><text x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23C9A227%22 font-size=%2248%22>G</text></svg>'">
                </div>
                <h3 class="font-serif text-2xl md:text-3xl font-bold text-gray-800">{{ $wedding->couple['groomName'] ?? '' }}</h3>
                <p class="text-gray-600 mt-2 text-sm">{{ $wedding->couple['groomParents'] ?? '' }}</p>
                @if($wedding->couple['groomInstagram'] ?? false)
                <a href="{{ $wedding->couple['groomInstagram'] }}" target="_blank" class="inline-flex items-center gap-1 mt-3 text-gold hover:text-gold-dark text-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    {{ $wedding->couple['groomInstagramHandle'] ?? '' }}
                </a>
                @endif
            </div>

            <div class="text-center" data-reveal="right">
                <div class="w-48 h-48 md:w-56 md:h-56 mx-auto rounded-full overflow-hidden border-4 border-gold shadow-lg mb-6">
                    <img src="{{ asset('images/bride/bride.jpg') }}" alt="{{ $wedding->couple['brideName'] ?? '' }}" class="w-full h-full object-cover" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22300%22 height=%22300%22><rect fill=%22%23E9DFC8%22 width=%22300%22 height=%22300%22/><text x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23C9A227%22 font-size=%2248%22>B</text></svg>'">
                </div>
                <h3 class="font-serif text-2xl md:text-3xl font-bold text-gray-800">{{ $wedding->couple['brideName'] ?? '' }}</h3>
                <p class="text-gray-600 mt-2 text-sm">{{ $wedding->couple['brideParents'] ?? '' }}</p>
                @if($wedding->couple['brideInstagram'] ?? false)
                <a href="{{ $wedding->couple['brideInstagram'] }}" target="_blank" class="inline-flex items-center gap-1 mt-3 text-gold hover:text-gold-dark text-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    {{ $wedding->couple['brideInstagramHandle'] ?? '' }}
                </a>
                @endif
            </div>
        </div>
    </div>
</section>
