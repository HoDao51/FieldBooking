function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price) + ' \u0111'
}

const timeSlots = document.querySelectorAll('.time-slot')

timeSlots.forEach(function(slot) {
    slot.addEventListener('click', function(e) {
        e.preventDefault()

        timeSlots.forEach(function(item) {
            item.classList.remove('ring-2', 'ring-green-500')
        })

        slot.classList.add('ring-2', 'ring-green-500')

        const selectedTime = document.getElementById('selectedTime')
        const totalPrice = document.getElementById('totalPrice')
        const hiddenPrice = document.getElementById('hiddenPrice')
        const hiddenTimeId = document.getElementById('hiddenTimeId')

        if (selectedTime) {
            selectedTime.value = slot.dataset.time
        }

        if (totalPrice) {
            totalPrice.innerText = formatPrice(slot.dataset.price)
        }

        if (hiddenPrice) {
            hiddenPrice.value = slot.dataset.price
        }

        if (hiddenTimeId) {
            hiddenTimeId.value = slot.dataset.timeId
        }
    })
})

const checkoutPage = document.querySelector('[data-checkout-page]')

if (checkoutPage) {
    const paymentTypeInputs = document.querySelectorAll('.payment-type')
    const payNowAmount = document.getElementById('payNowAmount')
    const paymentTypeLabel = document.getElementById('paymentTypeLabel')
    const fullPrice = checkoutPage.dataset.fullPrice
    const depositPrice = checkoutPage.dataset.depositPrice

    paymentTypeInputs.forEach(function(item) {
        item.addEventListener('change', function() {
            if (item.value == 1) {
                if (paymentTypeLabel) {
                    paymentTypeLabel.innerText = '\u0110\u1eb7t c\u1ecdc 50%'
                }

                if (payNowAmount) {
                    payNowAmount.innerText = formatPrice(depositPrice)
                }
            } else {
                if (paymentTypeLabel) {
                    paymentTypeLabel.innerText = 'Thanh to\u00e1n to\u00e0n b\u1ed9'
                }

                if (payNowAmount) {
                    payNowAmount.innerText = formatPrice(fullPrice)
                }
            }
        })
    })
}
