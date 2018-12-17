<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="fa fa-fw fa-cog text-secondary"></i></a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
               aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-user text-secondary"></i><span
                        class="caret text-secondary"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">Aksi</a></li>
                <li><a href="#">Aksi Lain</a></li>
            </ul>
        </li>
        <li><a href="{{ url('/admin-logout') }}" onclick="event.preventDefault();
								document.getElementById('logout-form').submit();"><i class="fa fa-fw fa-power-off text-secondary"></i></a>
        </li>
        {{-- TODO Make this with AJAX --}}
        <form id="logout-form" action="{{ url('/admin-logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </ul>
</div>