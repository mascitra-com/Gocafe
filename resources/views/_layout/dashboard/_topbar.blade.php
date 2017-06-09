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
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-fw fa-cog text-secondary"></i></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-user text-secondary"></i><span
                                class="caret text-secondary"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/logout') }}" onclick="event.preventDefault();
								document.getElementById('logout-form').submit();"><i class="fa fa-fw fa-power-off text-secondary"></i></a>
                </li>
                {{-- TODO Make this with AJAX --}}
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </ul>
        </div>
    </div>
</nav>