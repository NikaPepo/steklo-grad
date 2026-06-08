import './bootstrap';
import 'swiper/css';
import Swiper from 'swiper';
import {Navigation, Pagination} from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';
import './admin-modals.js';
import './animation.js';
import './contact-modal.js';
import './fancybox.js';
import './galleryPreview.js';
import './review-modal.js';
import './selectRebuild.js';
import './mobile-menu.js'


window.addEventListener("load", () => {
    const welcomeSwiper = new Swiper('.welcome-swiper', {
        modules: [Navigation],
        loop: true,
        speed: 600,

        navigation: {
            nextEl: document.querySelector('.welcome-next'),
            prevEl: document.querySelector('.welcome-prev'),
        }
    });
});
window.addEventListener("load", () => {
    const bannerSwiper = new Swiper('.banner-swiper', {
        modules: [Navigation, Pagination],
        loop: true,
        speed: 600,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },

        navigation: {
            nextEl: document.querySelector('.banner-next'),
            prevEl: document.querySelector('.banner-prev'),
        }
    });
});
window.addEventListener("load", () => {
    const GallerySwiper = new Swiper('.gallery-swiper', {
        modules: [Navigation, Pagination],
        loop: true,
        speed: 600,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: document.querySelector('.gallery-next'),
            prevEl: document.querySelector('.gallery-prev'),
        }
    });
});


