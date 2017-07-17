<div class="ui vertical segment container">
    <div class="ui grid">
        <div class="ten wide column" id="column-main-ads">
            @include('homepage._ads')
        </div>
        <div class="six wide column" id="column-side-ads">
            <div class="row image" style="height: 115px">
                <img data-src="{{ $topBanner }}">
            </div>
            <div class="row image" style="height: 115px; margin-top: 5px">
                <img data-src="{{ $bottomBanner }}">
            </div>
        </div>
    </div>
</div>