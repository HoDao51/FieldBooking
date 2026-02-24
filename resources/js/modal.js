// ===== OPEN MODAL CREATE =====
window.openModal = function (modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
};

// ===== CLOSE MODAL =====
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
    form.action = actionUrl;

    // Set các input bình thường (trừ avatar)
    Object.keys(data).forEach(key => {

        if (key === 'avatar') return; // ❗ Bỏ qua avatar

        const input = form.querySelector(`[name="${key}"]`);
        if (input) {
            input.value = data[key] ?? '';
        }
    });

    // ===== XỬ LÝ AVATAR PREVIEW =====
    const avatarPreview = document.getElementById('editAvatarPreview');
    const fileInput = form.querySelector('input[name="avatar"]');

    if (avatarPreview) {
        if (data.avatar) {
            avatarPreview.src = '/storage/' + data.avatar;
            avatarPreview.classList.remove('hidden');
        } else {
            avatarPreview.classList.add('hidden');
        }
    }

    // Reset file input
    if (fileInput) {
        fileInput.value = '';
    }

    document.getElementById(modalId).classList.remove('hidden');
    document.getElementById(modalId).classList.add('flex');
};