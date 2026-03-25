document.querySelectorAll('.time-slot').forEach(slot => {
    slot.addEventListener('click', function (e) {
        e.preventDefault()

        document.querySelectorAll('.time-slot').forEach(s => {
            s.classList.remove('ring-2', 'ring-green-500')
        })

        this.classList.add('ring-2', 'ring-green-500')

        let time = this.dataset.time
        let price = this.dataset.price
        let timeId = this.dataset.timeId

        document.getElementById('selectedTime').value = time

        document.getElementById('totalPrice').innerText =
            new Intl.NumberFormat('vi-VN').format(price) + 'đ'

        document.getElementById('hiddenPrice').value = price
        document.getElementById('hiddenTimeId').value = timeId
    })
})