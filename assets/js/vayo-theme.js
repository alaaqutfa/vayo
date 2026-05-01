(function () {
  const html = document.documentElement;
  const menuToggle = document.querySelector('.menu-toggle');
  const mobileNav = document.querySelector('#mobile-nav');
  const languageButtons = document.querySelectorAll('[data-lang][data-dir]');

  if (menuToggle && mobileNav) {
    menuToggle.addEventListener('click', function () {
      const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';
      menuToggle.setAttribute('aria-expanded', String(!isOpen));
      mobileNav.hidden = isOpen;
      document.body.classList.toggle('nav-open', !isOpen);
    });

    mobileNav.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        menuToggle.setAttribute('aria-expanded', 'false');
        mobileNav.hidden = true;
        document.body.classList.remove('nav-open');
      });
    });
  }

  languageButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      const lang = button.dataset.lang;
      const dir = button.dataset.dir;

      html.lang = lang;
      html.dir = dir;

      languageButtons.forEach(function (item) {
        item.classList.toggle('is-active', item === button);
      });
    });
  });
})();
