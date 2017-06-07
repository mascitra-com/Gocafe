var hostname = window.location.hostname;
$('.ui.rating').rating('disable');
function addSearchAttributes() {
    var order = $('input[name=order-by]').val();
    if(order) {
        $('<input />').attr('type', 'hidden')
            .attr('name', "order")
            .attr('value', order)
            .appendTo('#search');
    }
    var lowPrice = $('input[name=lowPrice]').val();
    if(lowPrice){
        $('<input />').attr('type', 'hidden')
            .attr('name', "lowPrice")
            .attr('value', lowPrice)
            .appendTo('#search');
    }
    var highPrice = $('input[name=highPrice]').val();
    if(highPrice){
        $('<input />').attr('type', 'hidden')
            .attr('name', "highPrice")
            .attr('value', highPrice)
            .appendTo('#search');
    }
    var location = $('#add-search-location').val();
    if(location){
        $('input[name=location]').val(location);
    }
}
$("#search-location").change(function() {
    addSearchAttributes();
    document.getElementById("search").submit();
});
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