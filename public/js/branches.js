var token = $('meta[name="csrf-token"]').attr('content');
var hostname = window.location.origin;
$("#provinces").on('change', function () {
    $("#cities").html("<option>Pilih Kabupaten / Kota</option>")
        .prop('disabled', true);
    $("#districts").html("<option>Pilih Kecamatan</option>")
        .prop('disabled', true);
    var id;
    var x = document.getElementById("provinces");
    for (var i = 0; i < x.options.length; i++) {
        if (x.options[i].selected) {
            id = x.options[i].value;
        }
    }
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': token}
    });
    $.ajax({
        type: 'POST',
        data: {'idProvince': id},
        dataType: "json",
        url: hostname + "/branch/getCitiesByProvince",
        success: function (data) {
            $("#cities").html(data)
                .prop('disabled', false);
        }
    });
});
$("#cities").on('change', function () {
    $("#districts").html("<option>Pilih Kecamatan</option>")
        .prop('disabled', true);
    var id;
    var x = document.getElementById("cities");
    for (var i = 0; i < x.options.length; i++) {
        if (x.options[i].selected) {
            id = x.options[i].value;
        }
    }
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': token}
    });
    $.ajax({
        type: 'POST',
        data: {'idCity': id},
        dataType: "json",
        url: hostname + "/branch/getDistrictByCity",
        success: function (data) {
            $("#districts").html(data)
                .prop('disabled', false);
        }
    });
});
