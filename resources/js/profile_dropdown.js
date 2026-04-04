const profileBtn = document.getElementById('profileBtn')
const profileDropdown = document.getElementById('profileDropdown')

if (profileBtn && profileDropdown) {
    profileBtn.addEventListener('click', function() {
        if (profileDropdown.classList.contains('hidden')) {
            profileDropdown.classList.remove('hidden')
            profileBtn.setAttribute('aria-expanded', 'true')
        } else {
            profileDropdown.classList.add('hidden')
            profileBtn.setAttribute('aria-expanded', 'false')
        }
    })

    window.addEventListener('click', function(e) {
        if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
            profileDropdown.classList.add('hidden')
            profileBtn.setAttribute('aria-expanded', 'false')
        }
    })
}
