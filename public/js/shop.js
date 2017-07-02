
var hostname = window.location.hostname;

$(document).ready(function() {
    $('.ui.star.rating').rating({
        maxRating: 5
    }).rating('disable');
});
$("a.brown").first().addClass("active");
$('.ui.dropdown').dropdown({
    on: 'hover'
});

$("a.brown").click(function(){
    $("a.brown").removeClass("active").eq($(this).index()).addClass('active');
    var idCategory = $(this).data("id");
    if(idCategory !== 0) {
        var menus = $('#productList').empty();
        $.ajax({
            url: "https://" + hostname + '/menus/getMenus/' + idCategory,
            dataType: 'json',
            success: function (response) {
                $.each(response.menus, function (i, menu) {
                    var id = menu.id;
                    var name = menu.name;
                    var price = $.number(menu.price, 0, '', '.');
                    var discount = menu.discount;
                    var rating = Math.floor(menu.rating);
                    var liked = menu.liked;
                    var reviewed = menu.reviewed;
                    var markup = "<a href='https://" + hostname + "/product/" + id + "' class='card product' data-id='" + id + "'><div class='image'><img src='" + menu.thumbnail + "'></div><div class='content'><div class='header'>" + name + "</div><span>";
                    if(!discount){
                        markup += "<b>Rp. "+price+"</b>";
                    } else {
                        markup += "<del style='color: grey'>Rp. "+price+"&nbsp;</del>";
                        price = menu.price - (menu.price * discount);
                        markup += "<b>&nbsp;Rp. "+ $.number(price) +"</b>";
                    }
                    markup += "</span></div><div class='extra content'><div class='ui heart rating' data-rating='"+liked+"' data-max-rating='1'></div> " + liked + " <span class='right floated'><div class='ui tiny star rating' data-rating='" + rating + "'></div>(" + reviewed + ")</span></div></a>";
                    $("#productList").append(markup);
                });
                $('.ui.star.rating').rating({
                    maxRating: 5
                }).rating('disable');
                $('.ui.heart.rating').rating('enable');
            }
        });
    }
});

$("#allMenu").click(function(){
    $('#productList').empty();
    var idCafe = $(this).data("cafe-id");
    $.ajax({
        url: "https://" + hostname + '/shop/allProducts/' + idCafe,
        dataType: 'json',
        success: function (response) {
            $.each(response.products, function (i, product) {
                var id = product.id;
                var name = product.name;
                var discount = product.discount;
                var price = $.number(product.price, 0, '', '.');
                var rating = Math.floor(product.rating);
                var liked = product.liked;
                var reviewed = product.reviewed;
                var priceMarkup = '';
                if(!discount){
                    priceMarkup += "<b>Rp. "+price+"</b>";
                } else {
                    priceMarkup += "<del style='color: grey'>Rp. "+price+"&nbsp;</del>";
                    price = product.price - (product.price * discount);
                    priceMarkup += "<b>&nbsp;Rp. "+ $.number(price) +"</b>";
                }
                var markup = "<a href='https://" + hostname + "/product/" + id + "' class='card product' data-id='" + id + "'><div class='image'><img src='" +  product.thumbnail  + "'></div><div class='content'><div class='header'>" + name + "</div><span>" + priceMarkup + "</span></div><div class='extra content'><div class='ui heart rating' data-rating='"+liked+"' data-max-rating='1'></div> " + liked + " <span class='right floated'><div class='ui tiny star rating' data-rating='" + rating + "'></div>(" + reviewed + ")</span></div></a>";
                $("#productList").append(markup);
            });
            $('.ui.star.rating').rating({
                maxRating: 5
            }).rating('disable');
            $('.ui.heart.rating').rating('enable');
        }
    });
});
