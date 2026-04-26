document.addEventListener('DOMContentLoaded', function () {
    const daySelect = document.getElementById('createDayOfWeek')
    const timeSelect = document.getElementById('createTimeId')

    if (!daySelect || !timeSelect) {
        return
    }

    const configuredTimeSlots = JSON.parse(daySelect.dataset.configuredTimeSlots || '{}')
    const defaultOptions = timeSelect.innerHTML
    const selectedTimeId = timeSelect.dataset.selectedTimeId

    function updateTimeSlots() {
        const dayOfWeek = daySelect.value
        const usedTimeSlots = configuredTimeSlots[dayOfWeek] || []

        timeSelect.innerHTML = defaultOptions

        const options = timeSelect.querySelectorAll('option')

        options.forEach(function (option) {
            if (!option.value) {
                return
            }

            if (usedTimeSlots.includes(Number(option.value))) {
                option.remove()
            }
        })

        if (timeSelect.options.length === 1) {
            const option = document.createElement('option')
            option.value = ''
            option.textContent = 'Không còn khung giờ trống'
            timeSelect.appendChild(option)
        }

        if (selectedTimeId) {
            const selectedOption = timeSelect.querySelector('option[value="' + selectedTimeId + '"]')

            if (selectedOption) {
                selectedOption.selected = true
            }
        }
    }

    daySelect.addEventListener('change', updateTimeSlots)
    updateTimeSlots()
})
