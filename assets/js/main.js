

document.addEventListener('DOMContentLoaded', () => {
  initMobileMenu();
  document.querySelectorAll('[data-slider]').forEach(initSlider);
});

function initMobileMenu() {
  const burger = document.querySelector('.site-header__burger');
  const nav = document.getElementById('site-nav');

  if (!burger || !nav) return;

  const toggle = (open) => {
    burger.setAttribute('aria-expanded', String(open));
    nav.classList.toggle('is-open', open);
  };

  burger.addEventListener('click', () => toggle(burger.getAttribute('aria-expanded') !== 'true'));

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') toggle(false);
  });

  window.matchMedia('(min-width: 992px)').addEventListener('change', (e) => {
    if (e.matches) toggle(false);
  });
}

function initSlider(slider) {
  const slides = slider.querySelectorAll('[data-slide]');
  const prev = slider.querySelector('[data-prev]');
  const next = slider.querySelector('[data-next]');
  let current = 0;

  if (slides.length < 2) return;

  const show = (index) => {
    slides[current].hidden = true;
    current = (index + slides.length) % slides.length;
    slides[current].hidden = false;
    slides[current].classList.add('is-fading');
  };

  prev?.addEventListener('click', () => show(current - 1));
  next?.addEventListener('click', () => show(current + 1));
}
