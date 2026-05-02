import TomSelect from 'tom-select'

document.addEventListener('DOMContentLoaded', function () {
    const customerSelect = document.getElementById('customerSelect')
    const facilitySelect = document.getElementById('facilitySelect')

    if (customerSelect) {
        new TomSelect('#customerSelect', {
            create: false,
            placeholder: 'Tìm khách hàng...',
            maxOptions: 100,
            render: {
                option(data, escape) {
                    return `<div style="padding: 1rem 1rem;">${escape(data.text)}</div>`
                }
            }
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
            render: {
                option(data, escape) {
                    return `<div style="padding: 1rem 1rem;">${escape(data.text)}</div>`
                }
            }
        })
    }
})
