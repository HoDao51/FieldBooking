// ===== OPEN MODAL CREATE =====
window.openModal = function (modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
};

// ===== CLOSE MODAL (DÙNG CHUNG) =====
window.closeModal = function (modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
};

// ===== OPEN EDIT MODAL =====
window.openEditModal = function ({ modalId, formId, actionUrl, data }) {

    const form = document.getElementById(formId);
    if (form) {
        form.action = actionUrl;

        Object.keys(data).forEach(key => {
            const input = form.querySelector(`[name="${key}"]`);
            if (input) {
                input.value = data[key] ?? '';
            }
        });
    }

    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
};