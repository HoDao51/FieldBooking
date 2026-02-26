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

window.openEditModal = function ({ modalId, formId, actionUrl, data }) {

    if (typeof resetEditPreview === 'function') {
        resetEditPreview();
    }

    const form = document.getElementById(formId);
    if (!form) return;

    form.action = actionUrl;

    Object.keys(data).forEach(key => {

        if (key === 'avatar' || key === 'images') return;

        const input = form.querySelector(`[name="${key}"]`);
        if (input) {
            input.value = data[key] ?? '';
        }
    });

    // ===== CHỈ XỬ LÝ ẢNH NẾU CÓ currentImages =====
    const currentImages = document.getElementById('currentImages');

    if (currentImages && data.images) {

        currentImages.innerHTML = '';

        data.images.forEach(image => {

            const wrapper = document.createElement('div');
            wrapper.classList.add('relative', 'w-16', 'h-16');

            const img = document.createElement('img');
            img.src = '/storage/' + image.name;
            img.classList.add('w-full', 'h-full', 'object-cover', 'rounded-lg', 'border');

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.innerHTML = '✕';
            removeBtn.classList.add(
                'absolute',
                '-top-2',
                '-right-2',
                'bg-red-600',
                'text-white',
                'w-5',
                'h-5',
                'rounded-full',
                'text-xs'
            );

            removeBtn.onclick = function () {

                const inputDelete = document.createElement('input');
                inputDelete.type = 'hidden';
                inputDelete.name = 'delete_images[]';
                inputDelete.value = image.id;

                form.appendChild(inputDelete);
                wrapper.remove();
            };

            wrapper.appendChild(img);
            wrapper.appendChild(removeBtn);
            currentImages.appendChild(wrapper);
        });
    }

    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
};