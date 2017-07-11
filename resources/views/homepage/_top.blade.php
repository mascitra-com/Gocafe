<div class="ui vertical segment container">
    <div class="ui grid">
        <div class="nine wide column" id="column-main-ads">
            @include('homepage._ads')
        </div>
        <div class="four wide column" id="column-side-ads">
            <div class="row image" style="width: 500px; height: 140px">
                <img data-src="{{ $topBanner }}">
            </div>
            <div class="row image" style="width: 500px; height: 140px; margin-top: 5px">
                <img data-src="{{ $bottomBanner }}">
            </div>
        </div>
    </div>
</div>