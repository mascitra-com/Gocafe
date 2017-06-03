<div class="ui vertical segment container">
    <div class="ui two column divided grid">
        <div class="row">
            <div class="six column">
                <div class="ui grid">
                    <div class="ui center aligned five wide column">
                        <img class="ui small image" src="{{ url('logo/'.$shop->id) }}">
                        <br>
                        <span class="fa-stack" style="color: grey" data-content="Ijin Toko Belum Terverifikasi">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa fa-check fa-stack-1x fa-inverse"></i>
                        </span>
                        <span class="fa-stack" style="color: grey" data-content="Nomor Telepon Belum Terverifikasi">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa fa-mobile-phone fa-stack-1x fa-inverse"></i>
                        </span>
                        <span class="fa-stack" style="color: grey" data-content="E-mail Belum Terverifikasi">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <div class="eleven wide column">
                        <h3>{{ $shop->name }}</h3>
                        <p>{{ $shop->description }}</p>
                        <a target="_blank" href="https://www.facebook.com/{{ $shop->facebook }}"><i class="fa fa-lg fa-facebook-square"></i> {{ $shop->facebook }}</a>&nbsp;&nbsp;
                        <a target="_blank" href="https://www.twitter.com/{{ $shop->twitter }}"><i class="fa fa-lg fa-twitter-square"></i> {{ $shop->twitter }}</a><br>
                        <a target="_blank" href="https://www.instagram.com/{{ $shop->instagram }}"><i class="fa fa-lg fa-instagram"></i> {{ $shop->instagram }}</a>&nbsp;&nbsp;
                        <span style="color: #F18803"><i class="fa fa-lg fa-phone-square"></i> {{ $shop->phone }}</span>
                        <div style="font-size: 8pt; margin-top: .5em" class="ui equal width grid">
                            <div class="column">Aktif Sejak : <br>{{ date('d M Y H:i', strtotime($shop->created_at)) }}</div>
                            <div class="column">Terakhir diakses : <br>{{ date('d M Y H:i', strtotime($shop->last_accessed)) }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="six column">
                <h3>Cabang</h3>
                @foreach($branches as $branch)
                    {!! $branch->google_maps !!}<br>
                    Cabang {{ $branch->location->name }}. <br>
                    Buka dari Pukul {{ $branch->open_hours }} sampai dengan {{ $branch->close_hours }}
                @endforeach
            </div>
        </div>
    </div>
</div>