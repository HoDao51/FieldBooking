function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price) + ' \u0111'
}

const timeSlots = document.querySelectorAll('.time-slot')

timeSlots.forEach(function (slot) {
    slot.addEventListener('click', function (e) {
        e.preventDefault()

        timeSlots.forEach(function (item) {
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
    const paymentTypeInputs = document.querySelectorAll('input[name="payment_type"]')
    const payNowAmounts = document.querySelectorAll('.payNowAmount')
    const paymentTypeLabel = document.getElementById('paymentTypeLabel')
    const fullPrice = Number(checkoutPage.dataset.fullPrice)

    const depositPrice = Number(checkoutPage.dataset.depositPrice)
    paymentTypeInputs.forEach(function (item) {
        item.addEventListener('change', function () {
            let amount
            if (this.value == 1) {
                amount = depositPrice
                if (paymentTypeLabel) {
                    paymentTypeLabel.innerText = 'Đặt cọc 50%'
                }
            } else {
                amount = fullPrice
                if (paymentTypeLabel) {
                    paymentTypeLabel.innerText = 'Thanh toán toàn bộ'
                }
            }
            payNowAmounts.forEach(function (el) {
                el.innerText = formatPrice(amount)
            })
        })
    })
}
