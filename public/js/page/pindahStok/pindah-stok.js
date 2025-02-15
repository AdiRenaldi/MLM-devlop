$(document).ready(function () {
    // Setup CSRF token untuk semua request
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Event option saat dipilih
    $("#kd_gudangAwal").on("change", function () {
        const $select1 = $("#kd_gudangAwal");
        const $select2 = $("#kd_gudangTujuan");

        const selectedValue = $select1.val();

        if (selectedValue) {
            $select2.prop("disabled", false);
            $select2.find("option").show();
            $select2.find(`option[value="${selectedValue}"]`).hide();
        } else {
            $select2.prop("disabled", true);
        }

        // format Rupiah
        function formatRupiahTanpaSimbol(angka) {
            angka = angka.toString().replace(",", ".");
            angka = parseFloat(angka);
            return angka.toLocaleString("id-ID");
        }

        // ambil data product berdasarkan gudang
        if (selectedValue) {
            $.ajax({
                url: "/stok/product",
                type: "POST",
                data: {
                    kd_gudangAwal: selectedValue,
                },
                success: function (response) {
                    $("#category_produk").val("");
                    $("#harga_produk").val("");
                    $("#jumlah_stok_gudang").val("");
                    $("#kdProduct").val("");
                    const stokData = response.data;
                    const selectElement = $("#namaProduk");
                    selectElement.empty();
                    selectElement.append(
                        '<option selected disabled class="bg-main text-white">Pilih Product</option>'
                    );

                    if (response.data && Array.isArray(response.data)) {
                        response.data.forEach(function (stok) {
                            if (stok.product) {
                                const IdStok = stok.kd_stokGudangUtama;
                                const namaProduct = stok.product.namaProduk;
                                selectElement.append(
                                    `<option value="${IdStok}">${namaProduct}</option>`
                                );
                            }
                        });
                        $("#namaProduk").on("change", function () {
                            const selectedValue = $(this).val();

                            const stokGudang = stokData.find(
                                (item) =>
                                    item.kd_stokGudangUtama === selectedValue
                            );

                            if (stokGudang) {
                                const category = stokGudang.product.category;
                                const harga = stokGudang.product.harga;
                                const jumlahStok = stokGudang.jumlahStok;
                                const kdProduct = stokGudang.product.kd_product;
                                $("#category_produk").val(category);
                                $("#harga_produk").val(
                                    formatRupiahTanpaSimbol(harga)
                                );
                                $("#jumlah_stok_gudang").val(jumlahStok);
                                $("#kdProduct").val(kdProduct);
                            } else {
                                console.log("Product not found.");
                            }
                        });
                    } else {
                        console.error(
                            "Data tidak valid atau produk tidak ditemukan!"
                        );
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error);
                },
            });
        }
    });

    // validasi form
    $("#stokForm").on("submit", function (event) {
        let jumlahStokGudang = parseInt($("#jumlah_stok_gudang").val()) || 0;
        let totalStok = parseInt($("#total_stok").val()) || 0;
        let errorMessage = $("#error-message");
        let inputTotalStok = $("#total_stok");

        if (totalStok > jumlahStokGudang) {
            event.preventDefault();
            errorMessage.removeClass("hidden");
            inputTotalStok.addClass("border-2 border-red-600");
        } else {
            errorMessage.addClass("hidden");
            inputTotalStok.removeClass("border-2 border-red-600");
        }
    });
});
