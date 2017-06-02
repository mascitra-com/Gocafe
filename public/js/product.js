var hostname = window.location.hostname;
$('.ui.rating').rating();
function addSearchAttributes() {
    $('<input />').attr('type', 'hidden')
        .attr('name', "order")
        .attr('value', $('input[name=order-by]').val())
        .appendTo('#search');
    $('<input />').attr('type', 'hidden')
        .attr('name', "lowPrice")
        .attr('value', $('input[name=lowPrice]').val())
        .appendTo('#search');
    $('<input />').attr('type', 'hidden')
        .attr('name', "highPrice")
        .attr('value', $('input[name=highPrice]').val())
        .appendTo('#search');
}
$("#order-by").change(function() {
    addSearchAttributes();
    document.getElementById("search").submit();
});
$("#lowPrice").blur(function() {
    addSearchAttributes();
    document.getElementById("search").submit();
}).on('keyup', function (e) {
    if (e.keyCode == 13) {
        addSearchAttributes();
        document.getElementById("search").submit();
    }
});
$("#highPrice").blur(function() {
    addSearchAttributes();
    document.getElementById("search").submit();
}).on('keyup', function (e) {
    if (e.keyCode == 13) {
        addSearchAttributes();
        document.getElementById("search").submit();
    }
});
document.getElementById("searchShop").addEventListener("click", function () {
    $('#search').attr('action', 'search/shop');
    document.getElementById("search").submit();
});
$('input.price').number(true, 0, ',', '.');
$('#search-location')
    .dropdown({
        fullTextSearch: true
    });
$('#order-by').dropdown();
$(document).ready(function() {
    $.ajax({
        url: "https://"+ hostname + '/get-provinces',
        dataType: 'json',
        success: function (response) {
            var markup = "";
            $.each(response.cities, function (i, city) {
                markup += "<div class='item' data-value='"+city.id+"'>"+city.name+"</div>";
            });
            $("#provinceListForSearch").append(markup);
        }
    });
});