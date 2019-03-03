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


function cart(){
    $.ajax({
        url: '/cart/modal',
        dataType: 'text',
        success: function (data) {
            $('#cart-items').empty();
            $('#cart-items').append(data);
            $('.item_amount').each(function() {
                var id = this.id;
                var key = id.substring(8, 9);
                $("#"+this.id).handleCounter({
                    minimum: 1,
                    maximize: null,
                    onChange: function(){
                        var amount = $('#amount-'+key).val();
                        var price = $('#price-'+key).val();
                        var total = amount * price;
                        $('#total-'+key).html(total);

                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        var item_id = $('#cart-item-'+key).val();
                        $.ajax({
                            url: '/cart/store',
                            dataType: 'json',
                            type: 'post',
                            data: {_token: CSRF_TOKEN, item:item_id, amount:amount},
                            success: function (response) {
                                $('#total_payment').html(response.total);
                            }
                        })
                    }
                })
            });
        }
    }).done(function () {
        $('.modal.cart').modal('show');
    });
}
