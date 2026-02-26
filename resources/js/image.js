function setupImagePreview(inputId, previewId) {

    const input = document.getElementById(inputId);
    const previewContainer = document.getElementById(previewId);

    if (!input || !previewContainer) return null;

    let fileStore = new DataTransfer();

    input.addEventListener('change', function (e) {

        Array.from(e.target.files).forEach(file => {

            fileStore.items.add(file);

            const reader = new FileReader();

            reader.onload = function (event) {

                const wrapper = document.createElement('div');
                wrapper.classList.add('relative');

                const img = document.createElement('img');
                img.src = event.target.result;
                img.classList.add(
                    'w-16',
                    'h-16',
                    'object-cover',
                    'rounded-lg',
                    'shadow'
                );

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.innerHTML = '✕';
                removeBtn.classList.add(
                    'absolute',
                    '-top-2',
                    '-right-2',
                    'bg-red-600',
                    'text-white',
                    'text-xs',
                    'w-5',
                    'h-5',
                    'rounded-full'
                );

                removeBtn.onclick = function () {

                    const index = Array.from(previewContainer.children).indexOf(wrapper);

                    fileStore.items.remove(index);
                    input.files = fileStore.files;

                    wrapper.remove();
                };

                wrapper.appendChild(img);
                wrapper.appendChild(removeBtn);
                previewContainer.appendChild(wrapper);
            };

            reader.readAsDataURL(file);
        });

        input.files = fileStore.files;
    });

    // Hàm reset để dùng khi mở lại modal
    return function resetPreview() {
        previewContainer.innerHTML = '';
        fileStore = new DataTransfer();
        input.value = '';
    };
}

/* ===== INIT ===== */

const resetCreatePreview = setupImagePreview('imageInput', 'previewContainer');
const resetEditPreview = setupImagePreview('editImageInput', 'editPreviewContainer');