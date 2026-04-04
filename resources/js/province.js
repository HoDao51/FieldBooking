document.addEventListener("DOMContentLoaded", function() {

        const select = document.getElementById("province");
        const selectedProvince = "{{ request('province') }}";

        fetch("https://provinces.open-api.vn/api/p/")
            .then(response => response.json())
            .then(data => {
                data.forEach(province => {

                    const option = document.createElement("option");
                    option.value = province.name;
                    option.textContent = province.name;

                    if (selectedProvince === province.name) {
                        option.selected = true;
                    }

                    select.appendChild(option);
                });
            })
            .catch(error => {
                console.error("Lỗi load tỉnh:", error);
            });

    });