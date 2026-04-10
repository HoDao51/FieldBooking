window.openModal = function(modalId) {
    const modal = document.getElementById(modalId)

    if (modal) {
        modal.classList.remove('hidden')
        modal.classList.add('flex')
    }
}

window.closeModal = function(modalId) {
    const modal = document.getElementById(modalId)

    if (modal) {
        modal.classList.add('hidden')
        modal.classList.remove('flex')
    }
}

window.openEditModal = function(data) {
    if (typeof resetEditPreview === 'function') {
        resetEditPreview()
    }

    const form = document.getElementById(data.formId)

    if (!form) {
        return
    }

    form.action = data.actionUrl

    Object.keys(data.data).forEach(function(key) {
        if (key === 'avatar' || key === 'images') {
            return
        }

        const input = form.querySelector('[name="' + key + '"]')

        if (input) {
            if (data.data[key]) {
                input.value = data.data[key]
            } else {
                input.value = ''
            }
        }
    })

    const conflictCheckboxes = form.querySelectorAll('.field-conflict-checkbox')

    if (conflictCheckboxes.length > 0) {
        conflictCheckboxes.forEach(function(checkbox) {
            checkbox.checked = false
        })

        if (data.data.conflict_fields) {
            conflictCheckboxes.forEach(function(checkbox) {
                data.data.conflict_fields.forEach(function(conflictId) {
                    if (checkbox.value == conflictId) {
                        checkbox.checked = true
                    }
                })
            })
        }
    }

    const roleWrapper = document.getElementById('editRoleWrapper')

    if (roleWrapper) {
        if (data.data.user_id == document.body.dataset.authId) {
            roleWrapper.style.display = 'none'
        } else {
            roleWrapper.style.display = 'block'
        }
    }

    const currentImages = document.getElementById('currentImages')

    if (currentImages && data.data.images) {
        currentImages.innerHTML = ''

        data.data.images.forEach(function(image) {
            const wrapper = document.createElement('div')
            wrapper.classList.add('relative', 'w-16', 'h-16')

            const img = document.createElement('img')
            img.src = '/storage/' + image.name
            img.classList.add('w-full', 'h-full', 'object-cover', 'rounded-lg', 'border', 'border-gray-200')

            const removeBtn = document.createElement('button')
            removeBtn.type = 'button'
            removeBtn.innerHTML = '×'
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
            )

            removeBtn.onclick = function() {
                const inputDelete = document.createElement('input')
                inputDelete.type = 'hidden'
                inputDelete.name = 'delete_images[]'
                inputDelete.value = image.id

                form.appendChild(inputDelete)
                wrapper.remove()
            }

            wrapper.appendChild(img)
            wrapper.appendChild(removeBtn)
            currentImages.appendChild(wrapper)
        })
    }

    openModal(data.modalId)
}
