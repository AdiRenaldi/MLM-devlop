$(document).ready(function () {
    // Setup CSRF token untuk semua request
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Event saat inputan diklik
    // $("#namaProduk").on("click", function () {
    //     $.ajax({
    //         url: "/gudangUtama/product",
    //         type: "POST",
    //         data: {
    //             kd_product: "dari ajax",
    //         },
    //         success: function (response) {
    //             console.log("Response:", response);
    //         },
    //         error: function (xhr, status, error) {
    //             console.error("Error:", error);
    //         },
    //     });
    // });

    // Event option saat dipilih
    document
        .getElementById("namaProduk")
        .addEventListener("change", function () {
            const selectedOption = this.options[this.selectedIndex];
            const category = selectedOption.getAttribute("category");
            let harga = selectedOption.getAttribute("harga");
            // harga = harga.split(",")[0];
            harga = parseInt(harga);
            document.getElementById("categoryProduk").value = category;
            document.getElementById("hargaProduk").value = harga;
        });
});
