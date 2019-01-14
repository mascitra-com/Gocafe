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
                            class="hidden-sm">Dasbor</span></a></li>
            @if(isset(Auth::guard("web")->user()->role))
                @if(Auth::guard("web")->user()->role == 'owner')
                <li class="nav-title">Informasi</li>
                <li><a href="{{ url('profile') }}"><i class="fa fa-fw fa-user"></i><span
                                class="hidden-sm">Profil Pemilik</span></a></li>
                <li class="nav-title">Manajemen Toko</li>
                <li><a href="{{ url('profile/cafe') }}"><i class="fa fa-fw fa-user"></i><span
                                class="hidden-sm">Profil</span></a></li>
                <li><a href="{{ url('branch') }}"><i class="fa fa-fw fa-users"></i><span
                                class="hidden-sm">Lokasi</span></a></li>
                <li><a href="{{ url('staff') }}"><i class="fa fa-fw fa-user-circle-o"></i><span
                                class="hidden-sm">Staf</span></a></li>
                <li class="nav-title">Manajemen Menu</li>
                <li><a href="{{ url('menus') }}"><i class="fa fa-fw fa-cutlery"></i><span
                                class="hidden-sm">Menu</span></a></li>
                <li><a href="{{ url('categories') }}"><i class="fa fa-fw fa-tag"></i><span class="hidden-sm">Kategori</span></a>
                <li class="nav-title">Manajemen Promosi</li>
                <li><a href="{{ url('batch_discount') }}"><i class="fa fa-fw fa-tags"></i><span class="hidden-sm">Diskon</span></a>
                <li class="nav-title">Laporan</li>
                <li><a href="{{ url('report') }}"><i class="fa fa-fw fa-money"></i><span class="hidden-sm">Transaksi</span></a>
                @else
                    <li class="nav-title">Transaksi</li>
                    <li><a href="{{ url('order') }}"><i class="fa fa-fw fa-coffee"></i><span class="hidden-sm">Pemesanan</span></a>
                    <li><a href="{{ url('payment') }}"><i class="fa fa-fw fa-money"></i><span class="hidden-sm">Pembayaran</span></a>
                    <li class="nav-title">Laporan</li>
                    <li><a href="{{ url('report/staff') }}"><i class="fa fa-fw fa-money"></i><span class="hidden-sm">Transaksi</span></a>
                @endif
            @else
            </li><li class="nav-title">Information</li>
            <li><a href="{{ url('info') }}"><i class="fa fa-fw fa-list"></i><span class="hidden-sm">Footer</span></a>
            <li><a href="{{ url('ads') }}"><i class="fa fa-fw fa-square"></i><span class="hidden-sm">Iklan</span></a>
            </li>
            @endif
        </ul>
    </div>
</div>