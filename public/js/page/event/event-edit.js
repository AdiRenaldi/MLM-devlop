$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    // Event ubah nomor kursi
    $(".btn-status").click(function () {
        let kode = $(this).data("kode");
        let nama = $(this).data("nama");
        let pangkat = $(this).data("pangkat");
        let kursi = $(this).data("kursi");

        $("#kode_member").val(kode);
        $("#nama_member").val(nama);
        $("#pangkat_member").val(pangkat);
        $("#nomor_kursi").val(kursi);
    });
});
