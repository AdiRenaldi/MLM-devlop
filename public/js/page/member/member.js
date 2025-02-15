$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#btn-reward").hide();
    $("#btn-hiden").show();
    $(".member-checkbox").change(function () {
        var selectedCount = $(".member-checkbox:checked").length;
        if (selectedCount > 0) {
            $("#btn-reward").show();
            $("#btn-hiden").hide();
        } else {
            $("#btn-reward").hide();
            $("#btn-hiden").show();
        }
    });
    $("#btn-hiden").click(function () {
        alert("Harap centeng member minimal 1 terlebih dahulu!");
    });

    // untuk ajax
    $("#btn-berikan").click(function () {
        var memberIds = [];
        var rewards = [];
        $(".member-checkbox:checked").each(function () {
            memberIds.push($(this).val());
        });
        $(".reward-checkbox:checked").each(function () {
            rewards.push($(this).val());
        });

        if (memberIds.length === 0 || rewards.length === 0) {
            alert("Harap pilih minimal satu reward!");
        } else {
            $.ajax({
                url: "/reward/beriReward",
                type: "POST",
                data: {
                    memberIds: memberIds,
                    rewards: rewards,
                },
                success: function (response) {
                    console.log(response);
                    window.location.reload();
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error);
                    console.log(status);
                },
            });
        }
    });
});
