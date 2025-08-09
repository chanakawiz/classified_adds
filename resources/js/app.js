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
  });
})();


