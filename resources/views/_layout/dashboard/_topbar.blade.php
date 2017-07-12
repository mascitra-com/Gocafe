<nav class="navbar navbar-default" id="nav-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" id="btn-menu" data-menu="#nav-side"><i
                        class="fa fa-bars btn-responsive"></i>@yield('page_title')</a>
        </div>
        @if(Auth::guard("web")->user())
            @include('_layout.dashboard._dropdown')
        @else
            @include('_layout.dashboard._adminDropdown')
        @endif
    </div>
</nav>