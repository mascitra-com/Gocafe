<div class="ui top attached segment">
    <p>{{ $shop->name }}</p>
</div>
<div class="ui attached segment shop-items" id="{{ $shop->key }}">
    <div class="ui middle aligned divided list">
    @each('cart.item', $shop->items, 'item')
    </div>
</div>
<div class="ui bottom attached segment">
    Subtotal : Rp. <span id="shop-total-{{ $shop->key }}">{{ $shop->total }}</span>
</div>