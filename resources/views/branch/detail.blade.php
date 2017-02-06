@extends('_layout/dashboard/index')
@section('page_title', 'Detail Cabang')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Detail Cabang</h3>
			</div>
			<div class="panel-body">
				<form action="{{ url('branch/'.$branch->id) }}" method="POST">
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
					<div class="form-group">
						<label for="">Lokasi</label>
						<div class="row">
							<div class="col-xs-12 col-md-4">
								<select name="province_id" class="form-control" id="provinces">
									<option value="">Pilh Provinsi</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->province_id }}" {{ $province->province_id == $branch->province_id ? 'selected' : ''}}>{{ $province->province_name_id }}</option>
                                    @endforeach
								</select>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <select name="city_id" class="form-control" id="cities">
                                    <option value="">Pilih Kabupaten</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->city_id }}" {{ $city->city_id == $branch->city_id ? 'selected' : ''}}>{{ $city->city_name_full }}</option>
                                    @endforeach
                                </select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="">Alamat</label>
						<textarea name="address" class="form-control" placeholder="alamat cabang">{{ $branch->address }}</textarea>
					</div>
					<div class="form-group">
						<label for="">Nomor Telpon</label>
						<input type="text" class="form-control" name="phone" placeholder="Nomor Telepon" value="{{ $branch->phone }}">
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<label for="">Jam Buka</label>
								<input type="text" class="form-control" name="open_hours" placeholder="Jam Nuka" value="{{ $branch->open_hours }}">
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<label for="">Jam Tutup</label>
								<input type="text" class="form-control" name="close_hours" placeholder="Jam Tutup" value="{{ $branch->close_hours }}">
							</div>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary" type="submit"><i class="fa fa-save fa-fw"></i> Perbaharui</button>
						<a href="{{ url('branch') }}" class="btn btn-default"><i class="fa fa-refresh fa-fw"></i> Kembali</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .nopadding {
            padding: 0;
        }

        .table > tbody tr td {
            padding-top: 20px;
            padding-bottom: 15px;
        }
    </style>
@endsection

@section('javascripts')
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        $("#provinces").on('change', function () {
            $("#cities").html("<option>Pilih Kabupaten / Kota</option>");
            $("#cities").prop('disabled', true);
            var id;
            var x = document.getElementById("provinces");
            for (var i = 0; i < x.options.length; i++) {
                if (x.options[i].selected) {
                    id = x.options[i].value;
                }
            }
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': token }
            });
            $.ajax({
                type: 'POST',
                data: { 'idProvince' : id },
                dataType: "json",
                url: "{{ url('branch/getCitiesByProvince') }}",
                success: function (data) {
                    $("#cities").html(data);
                    $("#cities").prop('disabled', false);
                }
            });
        });
    </script>
@endsection