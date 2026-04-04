document.querySelectorAll('[data-auto-open-modal]').forEach(function(item) {
    const modalId = item.dataset.autoOpenModal

    if (modalId && typeof openModal === 'function') {
        openModal(modalId)
    }
})
