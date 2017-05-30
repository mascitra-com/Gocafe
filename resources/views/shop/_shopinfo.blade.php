<div class="ui vertical segment container">
    <div class="ui two column divided grid">
        <div class="row">
            <div class="six column">
                <div class="ui grid">
                    <div class="ui center aligned five wide column">
                        <img class="ui small image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlHfIvsQ2CtsjxMC-GVIJFu7ab5I9GTdsMS5pelqZCFfvAYortrg">
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
                        <a target="_blank" href="https://www.facebook.com/{{ $shop->facebook }}"><i class="fa fa-lg fa-facebook-square"></i> </a>
                        <a target="_blank" href="https://www.twitter.com/{{ $shop->twitter }}"><i class="fa fa-lg fa-twitter-square"></i> </a>
                        <a target="_blank" href="https://www.instagram.com/{{ $shop->instagram }}"><i class="fa fa-lg fa-instagram"></i> </a><br>
                        <span style="color: #F18803">{{ $shop->phone }}</span>
                        <div style="font-size: 8pt; margin-top: .5em" class="ui equal width grid">
                            <div class="column">Aktif Sejak : <br>{{ date('d M Y H:i', strtotime($shop->created_at)) }}</div>
                            <div class="column">Terakhir diakses : <br>{{ date('d M Y H:i', strtotime($shop->last_accessed)) }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="six column">
                <table class="ui celled table">
                    <thead>
                    <th>Nama Cabang</th>
                    <th>Lokasi</th>
                    <th>Alamat</th>
                    <th>Jam Buka</th>
                    <th>Jam Tutup</th>
                    </thead>
                    <tbody>
                    @foreach($branches as $branch)
                        <tr>
                            <td>Cabang {{ $branch->location->name }}</td>
                            <td>
                                {{ isset($branch->location->city) ? $branch->location->city->name. ',' : '' }}
                                {{ isset($branch->location->province) ? $branch->location->province->name: '' }}
                            </td>
                            <td>{{ $branch->address }}</td>
                            <td>{{ $branch->open_hours }}</td>
                            <td>{{ $branch->close_hours }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>