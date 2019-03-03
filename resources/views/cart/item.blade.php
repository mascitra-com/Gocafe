<div class="item">
    <input type="hidden" id="cart-item-{{ $item->key }}" value="{{ $item->menu->id }}">
    <input type="hidden" id="price-{{ $item->key }}" value="{{ $item->menu->price }}">
    <div class="right floated content">
        Rp. <span class="total-price" id="total-{{ $item->key }}">{{ $item->total }}</span>
    </div>
    <img class="ui tiny image" src="{{ $item->thumbnail }}">
    <div class="content">
        <a href="{{ url('product/'.$item->item_id) }}">
            <h4 style="color: #8C4728; margin: 0">
                {{ $item->name }}
            </h4>
        </a>
        <div class="ui grid amount">
            <div class="ten wide column">
                <div class="handle-counter item_amount" id="counter-{{ $item->key }}">
                    <button class="counter-minus btn btn-primary">-</button>
                    <input type="text" class="amount" id="amount-{{ $item->key }}" value="{{ $item->amount }}">
                    <button class="counter-plus btn btn-primary">+</button>
                </div>
            </div>
        </div>
    </div>
</div>