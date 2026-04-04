const toast = document.getElementById('toast-success')

if (toast) {
    setTimeout(function() {
        toast.style.transition = 'all 0.5s ease'
        toast.style.opacity = '0'
        toast.style.transform = 'translate(-50%, -10px)'

        setTimeout(function() {
            toast.remove()
        }, 500)
    }, 3000)
}
