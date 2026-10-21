document.addEventListener('DOMContentLoaded', function () {
  new Swiper('.ksm-parallax-slider', {
    speed: 3000,
    loop: true,
    autoplay: {
    delay: 3000, // Time in ms between slides (3 seconds)
    disableOnInteraction: false, // Keeps autoplay running after user swipes/clicks
  },
  effect: 'slide', // Change transition type ('slide', 'fade', 'cube', 'coverflow', 'flip', 'cards')
    parallax: true,
    pagination: { el: '.swiper-pagination', clickable: true },
    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' }
  });
});