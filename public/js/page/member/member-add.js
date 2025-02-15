$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // ajax get kabupaten
    $("#provinsi").change(function () {
        var id = $(this).val();

        $.ajax({
            url: "/member/kabupaten/" + id,
            type: "GET",
            success: function (data) {
                $("#kabupaten").empty();
                $("#kabupaten").removeAttr("disabled");
                $("#kabupaten").append(
                    "<option selected disabled class='bg-main text-white'>Pilih Kabupaten</option>"
                );

                $.each(data, function (key, value) {
                    $("#kabupaten").append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.nama +
                            "</option>"
                    );
                });
            },
        });
    });

    // ajax get kecamatan
    $("#kabupaten").change(function () {
        var id = $(this).val();

        $.ajax({
            url: "/member/kecamatan/" + id,
            type: "GET",
            success: function (data) {
                $("#kecamatan").empty();
                $("#kecamatan").removeAttr("disabled");
                $("#kecamatan").append(
                    "<option selected disabled class='bg-main text-white'>Pilih Kecamatan</option>"
                );

                $.each(data, function (key, value) {
                    $("#kecamatan").append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.nama +
                            "</option>"
                    );
                });
            },
        });
    });
});
