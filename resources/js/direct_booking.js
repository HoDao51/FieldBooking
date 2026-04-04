const page = document.querySelector('[data-direct-booking-page]')

if (page) {
    const customerSelect = document.getElementById('customerSelect')
    const customerTypes = document.querySelectorAll('.customer-type')
    const existingSection = document.getElementById('existingCustomerSection')
    const nameInput = document.getElementById('contactName')
    const phoneInput = document.getElementById('contactPhone')
    const emailInput = document.getElementById('contactEmail')
    const summaryTime = document.getElementById('summaryTime')
    const summaryPriceTop = document.getElementById('summaryPriceTop')
    const summaryPrice = document.getElementById('summaryPrice')
    const summaryPayNow = document.getElementById('summaryPayNow')
    const summaryTotal = document.getElementById('summaryTotal')
    const hiddenTime = document.getElementById('hiddenTimeId')
    const hiddenPrice = document.getElementById('hiddenPrice')
    const timeSlots = document.querySelectorAll('.time-slot')

    function isGuest() {
        const selectedType = document.querySelector('input[name="customer_type"]:checked')

        if (selectedType) {
            return selectedType.value === 'guest'
        }

        return false
    }

    function formatPrice(price) {
        return new Intl.NumberFormat('vi-VN').format(price) + 'đ'
    }

    function updateCustomer() {
        if (isGuest()) {
            return
        }

        if (!customerSelect) {
            return
        }

        const selectedOption = customerSelect.options[customerSelect.selectedIndex]

        if (!selectedOption || !selectedOption.value) {
            return
        }

        if (nameInput.value.trim() === '') {
            nameInput.value = selectedOption.dataset.name
        }

        if (phoneInput.value.trim() === '') {
            phoneInput.value = selectedOption.dataset.phone
        }

        if (emailInput.value.trim() === '') {
            emailInput.value = selectedOption.dataset.email
        }
    }

    function toggleCustomerType() {
        const guest = isGuest()

        if (existingSection) {
            if (guest) {
                existingSection.classList.add('hidden')
            } else {
                existingSection.classList.remove('hidden')
            }
        }

        if (guest) {
            nameInput.readOnly = false
            phoneInput.readOnly = false
            emailInput.readOnly = false

            nameInput.classList.remove('bg-gray-100', 'text-gray-500', 'cursor-not-allowed')
            phoneInput.classList.remove('bg-gray-100', 'text-gray-500', 'cursor-not-allowed')
            emailInput.classList.remove('bg-gray-100', 'text-gray-500', 'cursor-not-allowed')

            nameInput.value = ''
            phoneInput.value = ''
            emailInput.value = ''
        } else {
            nameInput.readOnly = true
            phoneInput.readOnly = true
            emailInput.readOnly = true

            nameInput.classList.add('bg-gray-100', 'text-gray-500', 'cursor-not-allowed')
            phoneInput.classList.add('bg-gray-100', 'text-gray-500', 'cursor-not-allowed')
            emailInput.classList.add('bg-gray-100', 'text-gray-500', 'cursor-not-allowed')
        }

        updateCustomer()
    }

    function selectSlot(slot) {
        const formattedPrice = formatPrice(slot.dataset.price)

        timeSlots.forEach(function(item) {
            item.classList.remove('ring-2', 'ring-green-500')
        })

        slot.classList.add('ring-2', 'ring-green-500')

        hiddenTime.value = slot.dataset.timeId
        hiddenPrice.value = slot.dataset.price
        summaryTime.innerText = slot.dataset.time
        summaryPriceTop.innerText = formattedPrice
        summaryPrice.innerText = formattedPrice
        summaryPayNow.innerText = formattedPrice
        summaryTotal.innerText = formattedPrice
    }

    if (customerSelect) {
        customerSelect.addEventListener('change', function() {
            nameInput.value = ''
            phoneInput.value = ''
            emailInput.value = ''
            updateCustomer()
        })
    }

    customerTypes.forEach(function(item) {
        item.addEventListener('change', function() {
            if (isGuest()) {
                nameInput.value = ''
                phoneInput.value = ''
                emailInput.value = ''
            }

            toggleCustomerType()
        })
    })

    timeSlots.forEach(function(slot) {
        slot.addEventListener('click', function(e) {
            e.preventDefault()
            selectSlot(slot)
        })
    })

    toggleCustomerType()

    if (hiddenTime.value !== '') {
        timeSlots.forEach(function(slot) {
            if (slot.dataset.timeId === hiddenTime.value) {
                selectSlot(slot)
            }
        })
    }
}
