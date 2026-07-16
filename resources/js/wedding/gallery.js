import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import lightbox from 'lightbox2';
import 'lightbox2/dist/css/lightbox.min.css';

document.addEventListener('DOMContentLoaded', () => {
    const swiperEl = document.querySelector('.gallerySwiper');
    if (swiperEl) {
        new Swiper('.gallerySwiper', {
            slidesPerView: 1.2,
            spaceBetween: 16,
            loop: true,
            autoplay: { delay: 3500, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 20 },
                1024: { slidesPerView: 3, spaceBetween: 24 }
            }
        });
    }

    lightbox.option({
        resizeDuration: 200,
        wrapAround: true,
        albumLabel: 'Foto %1 dari %2',
    });
});
