<section id="gallery" class="py-20 md:py-32 section-bg overlay-dark" style="background-image: url('{{ asset('images/hero/gallery-bg.jpg') }}')">
    <div class="relative z-10 max-w-6xl mx-auto px-6">
        <h2 class="font-serif text-3xl md:text-4xl text-white font-light tracking-wide text-center text-shadow mb-16" data-reveal="fade">Gallery</h2>

        <div class="swiper gallerySwiper" data-reveal="up">
            <div class="swiper-wrapper">
                @foreach($wedding->galleries as $photo)
                <div class="swiper-slide px-2 pb-4">
                    <a href="{{ asset($photo->src) }}" data-lightbox="wedding-gallery" data-title="{{ $photo->title }}">
                        <div class="arch-img shadow-2xl border border-white/10 hover:border-white/30 transition-all duration-500">
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
