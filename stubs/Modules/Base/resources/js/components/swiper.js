import Swiper from 'swiper';

// eslint-disable-next-line import/no-unresolved
import 'swiper/css';
// eslint-disable-next-line import/no-unresolved
import 'swiper/css/navigation';
import { Navigation } from 'swiper';

// eslint-disable-next-line no-new
new Swiper('.swiper-gallery-block', {
    modules: [Navigation],
    slidesPerView: 1,
    spaceBetween: 15,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        320: {
            slidesPerView: 2,
            spaceBetween: 15,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 15,
        },
        1920: {
            slidesPerView: 4,
            spaceBetween: 15,
        },
    },
});
