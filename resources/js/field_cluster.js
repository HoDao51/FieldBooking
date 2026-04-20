function setupClusterInput(addressId, clusterId) {
    const addressInput = document.getElementById(addressId)
    const clusterInput = document.getElementById(clusterId)

    if (!addressInput || !clusterInput) {
        return
    }

    const url = addressInput.dataset.facilityUrl

    if (!url) {
        return
    }

    addressInput.addEventListener('blur', function () {
        const address = addressInput.value.trim()

        if (!address) {
            return
        }

        if (clusterInput.value.trim()) {
            return
        }

        fetch(url + '?address=' + encodeURIComponent(address))
            .then(function (response) {
                return response.json()
            })
            .then(function (data) {
                if (!data.cluster_name) {
                    return
                }

                clusterInput.value = data.cluster_name
                clusterInput.readOnly = true
                clusterInput.classList.add('bg-gray-100', 'cursor-not-allowed')
            })
    })

    addressInput.addEventListener('input', function () {
        if (!clusterInput.readOnly) {
            return
        }

        clusterInput.readOnly = false
        clusterInput.value = ''
        clusterInput.classList.remove('bg-gray-100', 'cursor-not-allowed')
    })
}

document.addEventListener('DOMContentLoaded', function () {
    setupClusterInput('createAddress', 'createClusterName')
    setupClusterInput('editAddress', 'editClusterName')
})
