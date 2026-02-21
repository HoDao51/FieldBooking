
    const btn = document.getElementById('profileBtn');
    const dropdown = document.getElementById('profileDropdown');
    btn.addEventListener('click', () => {
      const isHidden = dropdown.classList.contains('hidden');
      if (isHidden) {
        dropdown.classList.remove('hidden');
        btn.setAttribute('aria-expanded', 'true');
      } else {
        dropdown.classList.add('hidden');
        btn.setAttribute('aria-expanded', 'false');
      }
    });
    window.addEventListener('click', e => {
      if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.add('hidden');
        btn.setAttribute('aria-expanded', 'false');
      }
    });