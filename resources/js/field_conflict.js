let currentConflictFieldId = null;

window.openConflictModal = function (actionUrl, fieldName, fieldId, conflictFields){

    const form = document.getElementById('conflictForm');
    const fieldNameEl = document.getElementById('conflictFieldName');
    const searchInput = document.getElementById('conflictSearch');
    const items = document.querySelectorAll('.conflict-item');
    const checkboxes = document.querySelectorAll('.conflict-checkbox');

    if (!form) return;
    currentConflictFieldId = parseInt(fieldId);
    form.action = actionUrl;
    fieldNameEl.innerText = fieldName;
    searchInput.value = '';

    items.forEach(item => {
        const itemId = parseInt(item.dataset.id);
        if (itemId === currentConflictFieldId) {
            item.style.display = 'none';
        } else {
            item.style.display = 'flex';
        }
    });

    checkboxes.forEach(cb => {
        cb.checked = false;
    });

    if (conflictFields) {
        checkboxes.forEach(cb => {
            if (conflictFields.includes(parseInt(cb.value))) {
                cb.checked = true;
            }
        });
    }
    openModal('conflictModal');
}

document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById('conflictSearch');
    if (!searchInput) return;
    searchInput.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        const items = document.querySelectorAll('.conflict-item');
        items.forEach(item => {
            const itemId = parseInt(item.dataset.id);
            if (itemId === currentConflictFieldId) {
                item.style.display = 'none';
                return;
            }

            const name = item.dataset.name.toLowerCase();
            if (keyword === '' || name.includes(keyword)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    });
});