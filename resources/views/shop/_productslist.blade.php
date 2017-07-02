<div class="ui vertical segment container">
    <div class="ui grid">
        {{--Category List--}}
        <div class="three wide column">
            <h3>Menu</h3>
            <div class="ui secondary vertical menu">
                <a class="brown item" id="allMenu" data-cafe-id="{{ $shop->id }}">
                    Semua Menu
                </a>
                @foreach($categories as $category)
                    <a class="brown item" data-id="{{ $category->id }}">
                        {{ $category->name }}
                        {{--<div class="ui brown left label">21</div>--}}
                    </a>
                @endforeach
            </div>
        </div>
        {{--Product Showcase--}}
        <div class="thirteen wide column" style="padding-left: 2em">
            <h3>Produk</h3>
            <div class="ui four doubling cards" id="productList">
                {{--Product Card--}}
                @each('product._product', $products, 'product')
            </div>
        </div>
    </div>
</div>