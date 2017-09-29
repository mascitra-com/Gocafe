<div id="nav-side">
    <div id="nav-side-wrapper">
        <div id="nav-side-thumbnail" class="hidden-sm">
            <a href="{{ url('/') }}">
                <img src="{{ url('/images/logoname.png') }}" alt="Kulinerae" class="ui site-logo" height="35px">
            </a>
        </div>
        <ul class="nav">
            <li class="nav-close"><a href="#"><i class="fa fa-fw fa-close"></i></a></li>
            <li class="nav-active"><a href="{{ Auth::guard("web")->user() ? url('dashboard') : url('admin-dashboard') }}"><i class="fa fa-fw fa-home"></i><span
                            class="hidden-sm">Dashboard</span></a></li>
            @if(Auth::guard("web")->user())
            <li class="nav-title">Information</li>
            <li><a href="{{ url('profile') }}"><i class="fa fa-fw fa-user"></i><span
                            class="hidden-sm">Owner Profile</span></a></li>
            <li class="nav-title">Cafe</li>
            <li><a href="{{ url('profile/cafe') }}"><i class="fa fa-fw fa-user"></i><span
                            class="hidden-sm">Cafe Profile</span></a></li>
            <li class="nav-title">Cafe Branches</li>
            <li><a href="{{ url('branch') }}"><i class="fa fa-fw fa-users"></i><span
                            class="hidden-sm">Branches</span></a></li>
            <li class="nav-title">Menu</li>
            <li><a href="{{ url('menus') }}"><i class="fa fa-fw fa-cutlery"></i><span
                            class="hidden-sm">Menu Management</span></a></li>
            <li><a href="{{ url('categories') }}"><i class="fa fa-fw fa-tag"></i><span class="hidden-sm">Category Management</span></a>
            <li class="nav-title">Promotion</li>
            <li><a href="{{ url('batch_discount') }}"><i class="fa fa-fw fa-tags"></i><span class="hidden-sm">Discount Management</span></a>
            @else
            </li><li class="nav-title">Information</li>
            <li><a href="{{ url('info') }}"><i class="fa fa-fw fa-list"></i><span class="hidden-sm">Footer Content</span></a>
            <li><a href="{{ url('ads') }}"><i class="fa fa-fw fa-square"></i><span class="hidden-sm">Ads Content</span></a>
            </li>
            @endif
        </ul>
    </div>
</div>