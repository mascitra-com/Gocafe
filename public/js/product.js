var hostname = window.location.hostname;
$('.ui.rating').rating('disable');
$("#search-by-city").change(function() {
    addSearchAttributes();
    document.getElementById("search").submit();
});
$("#search-by-province").change(function() {
    $('input[name=city]').val('');
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
function addSearchAttributes() {
    var order = $('input[name=order-by]').val();
    if(order.length) {
        $('<input />').attr('type', 'hidden')
            .attr('name', "order")
            .attr('value', order)
            .appendTo('#search');
    } else {
        $('input[name=order-by]').val(order)
    }
    var lowPrice = $('input[name=lowPrice]').val();
    if(lowPrice){
        $('<input />').attr('type', 'hidden')
            .attr('name', "lowPrice")
            .attr('value', lowPrice)
            .appendTo('#search');
    } else {
        $('input[name=lowPrice]').val(lowPrice);
    }
    var highPrice = $('input[name=highPrice]').val();
    if(highPrice){
        $('<input />').attr('type', 'hidden')
            .attr('name', "highPrice")
            .attr('value', highPrice)
            .appendTo('#search');
    } else {
        $('input[name=highPrice]').val(highPrice);
    }
    var province = $('#add-search-province').val();
    $('input[name=province]').val(province);
    var city = $('#add-search-city').val();
    $('input[name=city]').val(city);
}
document.getElementById("searchShop").addEventListener("click", function () {
    $('#search').attr('action', 'search/shop');
    document.getElementById("search").submit();
});
$('input.price').number(true, 0, ',', '.');
$('#search-by-province')
    .dropdown({
        fullTextSearch: true
    });
$('#search-by-city')
    .dropdown({
        fullTextSearch: true
    });
$('#order-by').dropdown();
$(document).ready(function() {
    $.ajax({
        url: "https://" + hostname + '/get-provinces',
        dataType: 'json',
        success: function (response) {
            var markup = "<div class='item' data-value=''>Semua Lokasi</div>";
            $.each(response.provinces, function (i, province) {
                markup += "<div class='item' data-value='" + province.id + "'>" + province.name + "</div>";
            });
            $("#provinceListForSearch").append(markup);
        }
    });
    if($('#add-search-province').val()) {
        $.ajax({
            url: "https://" + hostname + '/get-city-by-province/' + $('#add-search-province').val(),
            dataType: 'json',
            success: function (response) {
                var markup = "<div class='item' data-value='0'>Semua Lokasi</div>";
                $.each(response.cities, function (i, city) {
                    markup += "<div class='item' data-value='" + city.id + "'>" + city.name + "</div>";
                });
                $("#cityListForSearch").append(markup);
            }
        });
    } else {
        $.ajax({
            url: "https://"+ hostname + '/get-cities',
            dataType: 'json',
            success: function (response) {
                var markup = "<div class='item' data-value=''>Semua Lokasi</div>";
                $.each(response.cities, function (i, city) {
                    markup += "<div class='item' data-value='"+city.id+"'>"+city.name+"</div>";
                });
                $("#cityListForSearch").append(markup);
            }
        });
    }
});