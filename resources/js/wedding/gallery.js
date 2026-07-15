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
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: { delay: 3000, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 }
            }
        });
    }

    lightbox.option({
        resizeDuration: 200,
        wrapAround: true,
        albumLabel: 'Foto %1 dari %2',
    });
});
