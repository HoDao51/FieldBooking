document.addEventListener("DOMContentLoaded", function () {
    // 1. TomSelect cho KHÁCH HÀNG
    const customerSelect = new TomSelect("#Select", {
        create: false,
        placeholder: "Tìm khách hàng...",
        maxOptions: 100,
        render: {
            option: function (data, escape) {
                return `
                    <div>
                        <div class="font-medium px-3 py-2">
                            ${escape(data.text)}
                        </div>
                    </div>
                `;
            }
        },
        onChange: function(value) {
            // Lấy thông tin từ option gốc
            const option = document.querySelector(`#Select option[value="${value}"]`);
            if (option) {
                document.getElementById('contactName').value = option.dataset.name || '';
                document.getElementById('contactPhone').value = option.dataset.phone || '';
                document.getElementById('contactEmail').value = option.dataset.email || '';
            }
        }
    });

    // 2. TomSelect cho SÂN BÓNG
    new TomSelect("#fieldSelect", {
        create: false,
        placeholder: "Tìm sân...",
        maxOptions: 50,
        render: {
            option: function (data, escape) {
                return `
                    <div>
                        <div class="font-medium px-3 py-2">
                            ${escape(data.text)}
                        </div>
                    </div>
                `;
            }
        },
        onChange: function(value) {
            if (value) {
                this.$input.closest('form').submit();
            }
        }
    });

    // Trigger ban đầu nếu có selected
    const initialCustomer = document.querySelector('#Select option[selected]');
    if (initialCustomer) {
        customerSelect.setValue(initialCustomer.value);
    }
});