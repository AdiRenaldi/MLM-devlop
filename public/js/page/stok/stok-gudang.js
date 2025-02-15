document.addEventListener("DOMContentLoaded", function () {
    // Event listener untuk tombol status
    document.addEventListener("click", function (event) {
        const button = event.target.closest(".btn-status");
        const kode = button.getAttribute("data-kode");
        const status = button.getAttribute("data-status");
        const inputKode = document.getElementById("kd_menageStock");
        const selectStatus = document.getElementById("status_gudang");

        inputKode.value = kode;
        if (selectStatus) {
            const options = selectStatus.options;
            for (let i = 0; i < options.length; i++) {
                if (options[i].value === status) {
                    options[i].selected = true;
                    break;
                }
            }
        }
    });
});
