$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    // aksi penerima notifikasi
    document
        .getElementById("filterMember")
        .addEventListener("change", function () {
            let inputs = document.querySelectorAll("#penerimaNotifikasi input");
            let memberInput = document.getElementById("member");
            let poinSilver = document.getElementById("poin_silver");
            let poinPlatinum = document.getElementById("poin_platinum");

            if (this.value === "0") {
                inputs.forEach((input) => {
                    input.classList.add("bg-gray-300");
                    input.classList.remove("bg-white");
                    input.setAttribute("disabled", "true");
                });
            } else if (this.value === "1") {
                memberInput.classList.remove("bg-gray-300");
                memberInput.classList.add("bg-white");
                memberInput.removeAttribute("disabled");

                poinSilver.classList.add("bg-gray-300");
                poinSilver.classList.remove("bg-white");
                poinSilver.setAttribute("disabled", "true");

                poinPlatinum.classList.add("bg-gray-300");
                poinPlatinum.classList.remove("bg-white");
                poinPlatinum.setAttribute("disabled", "true");
            } else if (this.value === "2") {
                poinSilver.classList.remove("bg-gray-300");
                poinSilver.classList.add("bg-white");
                poinSilver.removeAttribute("disabled");

                poinPlatinum.classList.remove("bg-gray-300");
                poinPlatinum.classList.add("bg-white");
                poinPlatinum.removeAttribute("disabled");

                memberInput.classList.add("bg-gray-300");
                memberInput.classList.remove("bg-white");
                memberInput.setAttribute("disabled", "true");
            }
        });

    //aksi tipe pengiriman

    document
        .getElementById("filterPengiriman")
        .addEventListener("change", function () {
            let inputs = document.querySelectorAll(
                "#pengirimanNotifikasi input"
            );
            let tanggalEksekusi = document.getElementById("tanggal_eksekusi");
            let periodeAwal = document.getElementById("periode_awal");
            let periodeAkhir = document.getElementById("periode_akhir");
            let jadwal = document.getElementById("jadwal");

            if (this.value === "0") {
                inputs.forEach((input) => {
                    input.classList.add("bg-gray-300");
                    input.classList.remove("bg-white");
                    input.setAttribute("disabled", "true");
                });
                jadwal.classList.add("bg-gray-300");
                jadwal.classList.remove("bg-white");
                jadwal.setAttribute("disabled", "true");
            } else if (this.value === "1") {
                tanggalEksekusi.classList.remove("bg-gray-300");
                tanggalEksekusi.classList.add("bg-white");
                tanggalEksekusi.removeAttribute("disabled");

                periodeAwal.classList.add("bg-gray-300");
                periodeAwal.classList.remove("bg-white");
                periodeAwal.setAttribute("disabled", "true");

                periodeAkhir.classList.add("bg-gray-300");
                periodeAkhir.classList.remove("bg-white");
                periodeAkhir.setAttribute("disabled", "true");

                jadwal.classList.add("bg-gray-300");
                jadwal.classList.remove("bg-white");
                jadwal.setAttribute("disabled", "true");
            } else if (this.value === "2") {
                periodeAwal.classList.remove("bg-gray-300");
                periodeAwal.classList.add("bg-white");
                periodeAwal.removeAttribute("disabled");

                periodeAkhir.classList.remove("bg-gray-300");
                periodeAkhir.classList.add("bg-white");
                periodeAkhir.removeAttribute("disabled");

                jadwal.classList.remove("bg-gray-300");
                jadwal.classList.add("bg-white");
                jadwal.removeAttribute("disabled");

                tanggalEksekusi.classList.remove("bg-white");
                tanggalEksekusi.classList.add("bg-gray-300");
                tanggalEksekusi.setAttribute("disabled", "true");
            }
        });
});
