var hostname = window.location.hostname;
function showMenus(idCategory) {
    $.ajax({
        url: '/menus/getMenus/' + idCategory,
        dataType: 'json',
        success: function (response) {
            $('#product').empty();
            var markup = '';
            if(response.menus){
                $.each(response.menus, function (i, menu) {
                    var id = menu.id;
                    var name = menu.name;
                    markup += "<button class='rectangle product' onclick=\"getProductDetail(\'" + id + "\')\"><img src='"+ getThumbnail(id) + "' alt='Thumbnail'>" + name +"</button>";
                });
                $("#product").append(markup);
            }
        }
    });
}

function getThumbnail(idMenu) {
    return "http://"+ hostname + "/menus/showThumbnail/" + idMenu;
}

function imageUrl(image) {
    return "http://"+ hostname + "/menus/showImage/" + image ;
}

function getProductDetail(idMenu) {
    $.ajax({
        url: '/menus/getMenu/' + idMenu,
        dataType: 'json',
        success: function (response) {
            $.each(response.menu, function (i, menu) {
                $('#head-menu').html(menu.name);
                $('#price').html("Rp. " + $.number(menu.price, 0, ',', '.') + ',-');
                $('#discount').html("- Rp. " + $.number(menu.price * menu.discount, 0, ',', '.') + ',-');
                $('#menu-desc').html(menu.description);
                $('#btn-add').html('<button class="btn btn-primary" onclick="addToCheck(\'' + menu.id +'\')"><i class="fa fa-plus"></i></button>');
                $('#big-thumbnail').attr('src', getThumbnail(menu.id));
                $('#item_id').val(menu.id);
                $('#total-rating').empty().append("<input value='" + menu.rating + "' class='rating-avg' data-size='xs' data-show-clear='false' data-show-caption='false' readonly>");
                $('.rating-avg').rating({displayOnly: true, step: 0.5});
                var images = menu.images_name.split(':').filter(n => n);
                var thumbnails = '';
                $('#thumbnails').find('div').remove();
                var k = 1;
                var imageSrc = '';
                $.each(images, function (i, image) {
                    if(image === 'default') {
                        imageSrc = imageUrl(images[i - k++]);
                    } else {
                        imageSrc = imageUrl(image);
                    }
                    thumbnails += "<div class='col-xs-6 col-md-3'><button class='thumbnail' onclick='changeBigThumbnail(\""+ imageSrc +"\")' data-src='"+ image +"'><img src='"+ imageSrc +"' alt='Thumbnail'></button></div>";
                });
                $('#thumbnails').html(thumbnails);
                $('#form-review').show();
            });
        }
    });
    $.ajax({
        url: '/transaction/getReviews/' + idMenu,
        dataType: 'json',
        success: function (response) {
            $("#table-review").find('tbody').empty();
            $.each(response.reviews, function (i, review) {
                var markup = "<tr><td width='15%'><img src='/images/blank-avatar.png' alt='' class='img-circle img-responsive'></td><td><p><input class='rating-avg' value='" + review.rating + "' class='rating' data-size='xs' data-show-clear='false' data-show-caption='false' readonly></p>" + review.review + "</td></tr>";
                $("#table-review").find('tbody').append(markup);
            });
            $('.rating-avg').rating({displayOnly: true, step: 0.5});
            $('#product-detail').modal('show');
        }
    });
}

function changeBigThumbnail(src) {
    $('#big-thumbnail').attr('src', src);
}