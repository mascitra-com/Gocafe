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
                    markup += "<button class='rectangle product' onclick=\"addMenuToCheck(\'" + id + "\')\"><img src='"+ menu.thumbnail + "' alt='Thumbnail'>" + name +"</button>";
                });
                $("#product").append(markup);
            }
        }
    });
}

function imageUrl(image) {
    var path = image.replace('product', 'img/cache/small-product');
    return "https://"+ hostname + "/" +  path;
}

function getProductDetail(idMenu) {
    $.ajax({
        url: '/menus/getMenu/' + idMenu,
        dataType: 'json',
        success: function (response) {
            $.each(response.menu, function (i, menu) {
                $('#head-menu').html(menu.name);
                $('#price').html("Rp. " + $.number(menu.price, 0, ',', '.') + ',-');
                $('#discount').html("Rp. " + $.number(menu.price * menu.discount, 0, ',', '.') + ',-');
                $('#menu-desc').html(menu.description);
                $('#btn-add').html('<button class="btn btn-primary" onclick="addMenuToCheck(\'' + menu.id +'\')"><i class="fa fa-plus"></i> Pesan</button>');
                $('#big-thumbnail').attr('src', menu.thumbnail);
                $('#item_id').val(menu.id);
                $('#total-rating').empty().append("<input value='" + menu.rating + "' class='rating-avg' data-size='xs' data-show-clear='false' data-show-caption='false' readonly>");
                $('.rating-avg').rating({displayOnly: true, step: 0.5});
                var images = menu.images.split(':').filter(n => n);
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
                var markup = "<tr><td width='15%'><img src='/images/blank-avatar.png' alt='' class='img-circle img-responsive'></td><td><p><input class='rating-avg' value='" + review.rating + "' class='rating' data-size='xs' data-show-clear='false' data-show-caption='false' readonly></p><p>" + review.review + "</p><p><span class='label label-default'>" + review.created_at + "</span></p></td></tr>";
                $("#table-review").find('tbody').append(markup);
            });
            $('.rating-avg').rating({displayOnly: true, step: 0.5});
            $('#product-detail').modal('show');
        }
    });
}

function changeBigThumbnail(src) {
    src = src.replace('small-product', 'large-product');
    $('#big-thumbnail').attr('src', src);
}