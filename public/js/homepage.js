var hostname = window.location.hostname;
$(document).ready(function() {
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