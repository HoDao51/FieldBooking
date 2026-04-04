let currentConflictFieldId = 0

window.openConflictModal = function(actionUrl, fieldName, fieldId, conflictFields) {
    const form = document.getElementById('conflictForm')
    const fieldNameEl = document.getElementById('conflictFieldName')
    const searchInput = document.getElementById('conflictSearch')
    const items = document.querySelectorAll('.conflict-item')
    const checkboxes = document.querySelectorAll('.conflict-checkbox')

    if (!form) {
        return
    }

    currentConflictFieldId = Number(fieldId)
    form.action = actionUrl
    fieldNameEl.innerText = fieldName

    if (searchInput) {
        searchInput.value = ''
    }

    items.forEach(function(item) {
        if (Number(item.dataset.id) === currentConflictFieldId) {
            item.style.display = 'none'
        } else {
            item.style.display = 'flex'
        }
    })

    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false

        if (conflictFields && conflictFields.includes(Number(checkbox.value))) {
            checkbox.checked = true
        }
    })

    openModal('conflictModal')
}

const conflictSearch = document.getElementById('conflictSearch')

if (conflictSearch) {
    conflictSearch.addEventListener('input', function() {
        const keyword = conflictSearch.value.toLowerCase().trim()
        const items = document.querySelectorAll('.conflict-item')

        items.forEach(function(item) {
            const itemId = Number(item.dataset.id)
            const itemName = item.dataset.name.toLowerCase()

            if (itemId === currentConflictFieldId) {
                item.style.display = 'none'
            } else if (keyword === '' || itemName.includes(keyword)) {
                item.style.display = 'flex'
            } else {
                item.style.display = 'none'
            }
        })
    })
}
