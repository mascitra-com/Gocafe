<div class="ui vertical segment container">
    <div class="ui grid">
        <div class="three wide column">
            Kategori
        </div>
        <div class="nine wide column" id="column-main-ads">
            @include('homepage._ads')
        </div>
        <div class="four wide column" id="column-side-ads">
            <div class="row image" style="width: 265px; height: 80px">
                <img data-src="{{ $topBanner }}" alt="Ads">
            </div>
            <div class="row image" style="width: 265px; height: 80px; margin-top: 5px">
                <img data-src="{{ $bottomBanner }}" alt="Ads">
            </div>
            <div class="row image" style="width: 265px; height: 80px; margin-top: 5px">
                <img data-src="{{ $bottomBanner }}" alt="Ads">
            </div>
        </div>
    </div>
</div>