<section id="gallery" class="py-16 md:py-24 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-center font-serif text-3xl md:text-4xl font-bold text-gray-800 mb-4" data-reveal="fade">Gallery</h2>
        <p class="text-center text-gold font-script text-2xl mb-12" data-reveal="scale">Momen Bahagia</p>

        <div class="swiper gallerySwiper" data-reveal="up">
            <div class="swiper-wrapper">
                @foreach($wedding->galleries as $photo)
                <div class="swiper-slide">
                    <a href="{{ asset($photo->src) }}" data-lightbox="wedding-gallery" data-title="{{ $photo->title }}">
                        <div class="rounded-xl overflow-hidden shadow-md aspect-[4/3]">
                            <img src="{{ asset($photo->src) }}" alt="{{ $photo->alt }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination mt-6 !relative"></div>
            <div class="swiper-button-prev !text-gold after:!text-2xl"></div>
            <div class="swiper-button-next !text-gold after:!text-2xl"></div>
        </div>
    </div>
</section>
