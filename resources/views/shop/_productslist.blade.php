<div class="ui vertical segment container">
    <div class="ui grid">
        {{--Category List--}}
        <div class="three wide column">
            <h3>Kategori</h3>
            <div class="ui secondary vertical menu">
                @foreach($categories as $category)
                    <a class="brown item" data-id="{{ $category->id }}">
                        {{ $category->name }}
                        {{--<div class="ui brown left label">21</div>--}}
                    </a>
                @endforeach
            </div>
            <h3>Informasi</h3>
            <div class="ui secondary vertical menu">
                <a class="item">
                    Tentang Kami
                </a>
                <a class="item">
                    Syarat & Ketentuan
                </a>
                <a class="item">
                    Hubungi Kami
                </a>
            </div>
        </div>
        {{--Product Showcase--}}
        <div class="thirteen wide column" style="padding-left: 2em">
            <h3>Produk</h3>
            <div class="ui three doubling cards" id="productList">
                {{--Product Card--}}
                @each('shop._product', $products, 'product')
            </div>
        </div>
    </div>
</div>