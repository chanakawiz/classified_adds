// Theme toggling with localStorage and OS preference
(function () {
  const storageKey = 'theme';
  const classNameDark = 'dark';

  function getPreferredTheme() {
    const stored = localStorage.getItem(storageKey);
    if (stored === 'light' || stored === 'dark') return stored;
    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  }

  function applyTheme(theme) {
    const root = document.documentElement;
    if (theme === 'dark') root.classList.add(classNameDark);
    else root.classList.remove(classNameDark);
  }

  // Apply on first load as early as possible
  applyTheme(getPreferredTheme());

  // Toggle handler
  function toggleTheme() {
    const next = document.documentElement.classList.contains(classNameDark) ? 'light' : 'dark';
    localStorage.setItem(storageKey, next);
    applyTheme(next);
  }

  // Attach to any button with data-theme-toggle
  window.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-theme-toggle]').forEach((el) => {
      el.addEventListener('click', toggleTheme);
    });

    // Mobile nav toggle
    const toggleBtn = document.querySelector('[data-mobile-nav-toggle]');
    const mobileNav = document.getElementById('mobileNav');
    if (toggleBtn && mobileNav) {
      toggleBtn.addEventListener('click', () => {
        mobileNav.classList.toggle('hidden');
        const expanded = toggleBtn.getAttribute('aria-expanded') === 'true';
        toggleBtn.setAttribute('aria-expanded', String(!expanded));
      });
    }

    // Side drawer for categories (not on home)
    const sideToggle = document.querySelector('[data-side-nav-toggle]');
    const sideCloseBtns = document.querySelectorAll('[data-side-nav-close]');
    const side = document.getElementById('sideNav');
    const sideBackdrop = document.getElementById('sideNavBackdrop');

    function openSide(){
      if (!side) return;
      side.classList.remove('-translate-x-full');
      sideBackdrop && sideBackdrop.classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }
    function closeSide(){
      if (!side) return;
      side.classList.add('-translate-x-full');
      sideBackdrop && sideBackdrop.classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }
    sideToggle && sideToggle.addEventListener('click', openSide);
    sideCloseBtns.forEach(btn => btn.addEventListener('click', closeSide));
    sideBackdrop && sideBackdrop.addEventListener('click', closeSide);
  });
})();


