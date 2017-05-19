// <div class="ui long modal">
//     <i class="close icon"></i>
//     <div class="header">
//     Profile Picture
// </div>
// <div class="content">
//     <div class="ui grid">
//     <div class="row">
//     <div class="eight wide column">
//     <img src="" id="big-thumbnail" class="ui fluid image">
//     </div>
//     <div class="eight wide column">
//     <div class="ui header">We've auto-chosen a profile image for you.</div>
// <p>We've grabbed the following image from the <a href="https://www.gravatar.com" target="_blank">gravatar</a> image associated with your registered e-mail address.</p>
// <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aut ducimus eligendi fugiat hic maiores non odio optio, porro rem repellendus reprehenderit tempora temporibus ullam, vel. Amet cum pariatur reprehenderit! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos obcaecati odit omnis perspiciatis quasi velit voluptatem! Cum, hic, iste! Ad alias animi aperiam dolorem eligendi incidunt perspiciatis quos repellendus sequi?</p>
// <p>Is it okay to use this photo?</p>
// </div>
// </div>
// <div class="row">
//     <div class="sixteen wide column">
//     <div class="ui four doubling cards" id="thumbnails">
//     </div>
//     </div>
//     </div>
//     </div>
//     </div>
//     </div>
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

$('.card.product').click(productDetail);

function productDetail(event){
    var productId = $(event.currentTarget).data("id");
    $('#big-thumbnail').attr('src', getThumbnail(productId));
    $('#thumbnails').find('div').remove();
    $.ajax({
        url: "http://"+ hostname + '/menus/getMenu/' + productId,
        dataType: 'json',
        success: function (response) {
            var thumbnails = '';
            var images = '';
            $.each(response.menu, function (i, menu) {
                $('.modal > .header').html(menu.name);
                images = menu.images_name.split(':').filter(n => n);
            });
            var k = 1;
            var imageSrc = '';
            $.each(images, function (i, image) {
                if(image === 'default') {
                    imageSrc = imageUrl(images[i - k++]);
                } else {
                    imageSrc = imageUrl(image);
                }
                thumbnails += "<a class='card' onclick='changeBigThumbnail(\""+ imageSrc +"\")' ><div class='image'><img src='" + imageSrc + "'></div></a>";
            });
            $('#thumbnails').html(thumbnails);
            $('.ui.long.modal').modal('toggle')
        }
    });
}

function imageUrl(image) {
    return "http://"+ hostname + "/menus/showImage/" + image ;
}

$("a.brown").click(function(){
    $("a.brown").removeClass("active").eq($(this).index()).addClass('active');
    var idCategory = $(this).data("id");
    var menus = $('#productList').empty();
    $.ajax({
        url: "http://"+ hostname + '/menus/getMenus/' + idCategory,
        dataType: 'json',
        success: function (response) {
            $.each(response.menus, function (i, menu) {
                var id = menu.id;
                var name = menu.name;
                var price = $.number(menu.price, 0, '', '.');
                var rating = Math.floor(menu.rating);
                var markup = "<a class='card product' data-id='"+id+"'><div class='image'><img src='" + getThumbnail(id) + "'></div><div class='content'><div class='header'>" + name + "</div></div><div class='extra content'><span><i class='money brown icon'></i><b>Rp." + price + "</b></span><span class='right floated'><div class='ui star rating right floated' data-rating='" + rating + "'></div></span></div></a>";
                $("#productList").append(markup);
            });
            $('#productList').delegate('a.card.product', 'click', productDetail);
            $('.ui.star.rating').rating({
                maxRating: 5
            }).rating('disable');
        }
    });
});

function getThumbnail(idMenu) {
    return "http://" + hostname + "/menus/showThumbnail/" + idMenu;
}

function changeBigThumbnail(src) {
    $('#big-thumbnail').attr('src', src);
}