var hostname = window.location.hostname;
$(document).ready(function() {
    $('.card-island').each(function () {
        var bg = $(this).data('gambar');
        $(this).css('background-image', 'url('+bg+')');
    });
    $('.card-category').each(function () {
        var bg = $(this).data('gambar');
        $(this).css('background-image', 'url('+bg+')');
    });
    $('#location')
        .dropdown({
            fullTextSearch: true
        });
    $.ajax({
        url: "https://"+ hostname + '/get-cities',
        dataType: 'json',
        success: function (response) {
            var markup = "";
            $.each(response.cities, function (i, city) {
                markup += "<div class='item' data-value='"+city.id+"'>"+city.name+"</div>";
            });
            $("#provinceList").append(markup);
        }
    });
});

$('#category-menu').hide();

$('#category-btn').on('click', function () {
    $('#category-menu').slideToggle(500);
    $('.pusher').dimmer('toggle');
});
$('.pusher').dimmer({
    onHide : function () {
        $('#category-menu').slideUp(500);
    }
});
