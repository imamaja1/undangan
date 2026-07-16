<section id="gallery" class="py-20 md:py-32 section-bg overlay-warm" style="background-image: url('{{ asset('images/hero/gallery-bg.jpg') }}?v={{ @filemtime(public_path('images/hero/gallery-bg.jpg')) }}')">
    <div class="relative z-10 max-w-6xl mx-auto px-6">
        <p class="text-center text-rose-base/40 font-sans text-[10px] tracking-[0.5em] uppercase mb-3" data-reveal="fade">Our Moments</p>
        <h2 class="font-serif text-3xl md:text-5xl text-white font-normal tracking-wide text-center text-shadow mb-4" data-reveal="fade" data-reveal-delay="100">Gallery</h2>
        <div class="divider-ornament mb-16" data-reveal="fade" data-reveal-delay="200">
            <div class="divider-ornament-icon"></div>
        </div>

        <div class="swiper gallerySwiper" data-reveal="up" data-reveal-delay="300">
            <div class="swiper-wrapper">
                @foreach($wedding->galleries as $photo)
                <div class="swiper-slide px-2 pb-4">
                    <a href="{{ asset($photo->src) }}" data-lightbox="wedding-gallery" data-title="{{ $photo->title }}">
                        <div class="frame-round rounded-2xl">
                            <img src="{{ asset($photo->src) }}" alt="{{ $photo->alt }}" class="w-full aspect-[3/4] object-cover hover:scale-105 transition-transform duration-700" loading="lazy">
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination mt-8 !relative"></div>
        </div>
    </div>
</section>
