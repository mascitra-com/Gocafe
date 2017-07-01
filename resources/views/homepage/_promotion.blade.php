<div class="ui vertical segment container">
    <div class="ui grid">
        <div class="ten wide column">
            @include('homepage._ads')
        </div>
        <div class="six wide column">
            <div class="row">
                <img src="{{ url('adsBanner/'.$topBanner->id) }}" width="400px" alt="Image">
            </div>
            <div class="row">
                <img src="{{ url('adsBanner/'.$bottomBanner->id) }}" width="400px" alt="Image">
            </div>
        </div>
    </div>
</div>