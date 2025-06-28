// assets/scripts/dark-mode.js

(function () {
  const root = document.documentElement;
  const toggleBtn = document.querySelector('[data-dark-toggle]');

  // 1. Determine stored preference
  const userPref = localStorage.getItem('dark');
  const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

  // 2. Apply theme on load
  if (userPref === 'true') {
    root.classList.add('dark');
  } else if (userPref === null && systemPrefersDark) {
    // Follow system preference only if user hasn't chosen
    root.classList.add('dark');
  }

  // 3. Sync with cookie (for server-side detection if needed)
  function syncDarkCookie(enabled) {
    const expires = new Date();
    expires.setFullYear(expires.getFullYear() + 1);
    document.cookie = `dark=${enabled}; expires=${expires.toUTCString()}; path=/`;
  }

  // 4. Toggle button handler
  if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
      const isDark = root.classList.toggle('dark');
      localStorage.setItem('dark', isDark);
      syncDarkCookie(isDark);
    });
  }
})();
