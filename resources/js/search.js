import TomSelect from 'tom-select'
import 'tom-select/dist/css/tom-select.css'

document.addEventListener('DOMContentLoaded', function () {
    const customerSelect = document.getElementById('customerSelect')
    const facilitySelect = document.getElementById('facilitySelect')

    if (customerSelect) {
        new TomSelect('#customerSelect', {
            create: false,
            placeholder: 'Tìm khách hàng...',
            maxOptions: 100,
        })
    }

    if (facilitySelect) {
        new TomSelect('#facilitySelect', {
            create: false,
            placeholder: 'Tìm cụm sân...',
            maxOptions: 50,
            onChange: function (value) {
                if (value) {
                    this.input.closest('form').submit()
                }
            },
        })
    }
})
