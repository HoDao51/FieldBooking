document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('province')

    if (!select) {
        return
    }

    const selectedProvince = select.dataset.selected

    fetch('/data/data.json')
        .then(function (response) {
            return response.json()
        })
        .then(function (data) {
            data.forEach(function (province) {
                const option = document.createElement('option')
                option.value = province.Name
                option.textContent = province.Name

                if (selectedProvince && selectedProvince == province.Name) {
                    option.selected = true
                }

                select.appendChild(option)
            })
        })
})
