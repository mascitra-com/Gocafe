@extends('_layout.homepage.index')
@section('page_title', 'Keranjang Belanja')
@section('content')
    <div class="ui breadcrumb container grid" id="top">
        <div class="twelve wide column">
            <a class="section" href="{{ url('/') }}">Home</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="{{ url('cart') }}">Keranjang Belanja</a>
        </div>
    </div>
    <div class="ui grid container">
        <h3>Keranjang Belanja</h3>
    </div>
    <div class="ui grid container">
        <div class="ten wide column">
            <div class="ui segment">
                <div class="ui checkbox">
                    <input type="checkbox" name="all" id="all">
                    <label for="all">Pilih Semua Item</label>
                </div>
            </div>
            @each('cart.shop-items', $cafes, 'shop')
        </div>
        <div class="six wide column">
            <div class="ui segments">
                <div class="ui segment">
                    Ringkasan Belanja
                </div>
                <div class="ui secondary segment">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script>
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
        $('.amount').change(function () {
            console.log('hit');
        });
    </script>
@endsection
