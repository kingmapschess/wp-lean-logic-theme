// assets/scripts/dark-mode.js

(function () {
  const root = document.documentElement;
  const toggleBtn = document.querySelector('[data-dark-toggle]');

  // Check stored preference on load
  const prefersDark = localStorage.getItem('dark') === 'true' || document.cookie.includes('dark=true');

  if (prefersDark) {
    root.classList.add('dark');
  }

  // Optional: Update cookie (for use in PHP context)
  function syncDarkCookie(enabled) {
    const expires = new Date();
    expires.setFullYear(expires.getFullYear() + 1); // 1 year
    document.cookie = `dark=${enabled}; expires=${expires.toUTCString()}; path=/`;
  }

  if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
      const isDark = root.classList.toggle('dark');
      localStorage.setItem('dark', isDark);
      syncDarkCookie(isDark);
    });
  }
})();
