document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("click", function (event) {
        let button;

        // Cek apakah yang diklik adalah tombol #btn-type atau #btn-status
        if (event.target.closest("#btn-type")) {
            button = event.target.closest("#btn-type");
            updateForm(button, "type");
        } else if (event.target.closest("#btn-status")) {
            button = event.target.closest("#btn-status");
            updateForm(button, "status");
        }
    });

    function updateForm(button, type) {
        if (!button) return; // Jika button tidak ditemukan, keluar dari fungsi

        const kode = button.getAttribute("data-kode");
        const status = button.getAttribute("data-status");

        if (type === "type") {
            const inputKode = document.getElementById("kd_promo_type");
            inputKode.value = kode;
        } else if (type === "status") {
            const inputKode = document.getElementById("kd_promo");
            inputKode.value = kode;
        }
        const selectElement = document.getElementById(type);

        // if (inputKode) inputKode.value = kode;
        if (selectElement) {
            Array.from(selectElement.options).forEach((option) => {
                option.selected = option.value === status;
            });
        }
    }
});
