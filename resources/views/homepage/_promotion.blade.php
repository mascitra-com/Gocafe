<div class="ui vertical segment container">
    <div class="ui grid">
        <div class="ten wide column">
            @include('homepage._ads')
        </div>
        <div class="six wide column">
            <div class="row">
                <img src="{{ $topBanner }}" width="405px" alt="Image">
            </div>
            <div class="row">
                <img src="{{ $bottomBanner }}" width="405px" alt="Image">
            </div>
        </div>
    </div>
</div>