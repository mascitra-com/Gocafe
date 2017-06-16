@extends('_layout/dashboard/index')
@section('page_title', 'Cafe Profile')

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">var base_url = '{{ url()->full() }}'</script>
@stop

@section('content')
	<div class="row">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul style="margin: 0 1em">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
		<div class="col-xs-12 col-md-8">
			<div class="panel panel-default">
				<div class="panel-body">
					<h3 class="panel-title">Informasi Dasar</h3><br>
					<form action="{{ URL('profile/cafe/'.(($cafe != NULL) ? $cafe->id : '')) }}" method="POST">
                        {{ ($cafe != NULL) ? method_field('PATCH') : ''}}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama Toko</label>
                                    <input type="text" class="form-control" name="name" placeholder="Cafe Name" value="{{ ($cafe == NULL) ? old('name') : $cafe->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Jenis Toko</label>
                                    <select name="shop_category_id" id="shop_category_id" class="form-control">
                                        <option value="">Pilih Jenis Toko</option>
                                        @foreach($shop_cat as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $cafe->shop_category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
						<div class="form-group">
							<label for="">Deskripsi Toko</label>
							<textarea name="description" class="form-control" placeholder="Cafe Description" rows="5">{{ ($cafe == NULL) ? old('description') : $cafe->description }}</textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
							<button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> Kembalikan</button>
						</div>
					</form>
                    <div class="panel-body box-center">
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="panel-title">Logo</h4>
                                <img src="{{url('logo/'.(($cafe != NULL) ? $cafe->id : ''))}}" class="image-fit img-circle" width="150px" alt="foto">
                                <div class="break-10"></div>
                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#upload">Ganti Logo</button>
                                <button class="btn btn-default btn-xs">Hapus</button>
                            </div>
                            <div class="col-md-8">
                                <h4 class="panel-title">Cover</h4>
                                <img src="{{url('cover/'.(($cafe != NULL) ? $cafe->id : ''))}}" class="image-fit img-rounded" width="400px" alt="foto">
                                <div class="break-10"></div>
                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#uploadCover">Ganti Cover</button>
                                <button class="btn btn-default btn-xs">Hapus</button>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<h3 class="panel-title">Info Kontak</h3><br>
                    <form action="{{ URL('profile/cafe/updateContact/'.($cafe == NULL ? '' : $cafe->id)) }}" method="POST">
                        {{ method_field('PATCH')}}
                        {{ csrf_field() }}
                        <div class="form-group">
							<label for=""><i class="fa fa-phone"></i> Phone Number</label>
							<input type="text" class="form-control" name="phone" placeholder="Phone Number" value="{{ ($cafe == NULL) ? old('phone') : $cafe->phone }}">
						</div>
						<div class="form-group">
							<label for=""><i class="fa fa-facebook"></i> Facebook</label>
							<input type="text" class="form-control" name="facebook" placeholder="Facebook" value="{{ ($cafe == NULL) ? old('facebook') : $cafe->facebook }}">
						</div>
						<div class="form-group">
							<label for=""><i class="fa fa-twitter"></i> Twitter</label>
							<input type="text" class="form-control" name="twitter" placeholder="Twitter" value="{{ ($cafe == NULL) ? old('twitter') : $cafe->twitter }}">
						</div>
						<div class="form-group">
							<label for=""><i class="fa fa-instagram"></i> Instagram</label>
							<input type="text" class="form-control" name="instagram" placeholder="Instagram" value="{{ ($cafe == NULL) ? old('instagram') : $cafe->instagram }}">
						</div>
						<div class="form-group">
							<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
							<button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> Kembalikan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="upload">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Upload Foto</h4>
                </div>
                <div class="modal-body">
                    <form id="updateAvatar">
                        <div class="form-group">
                            <label for="avatar" class="text-quadruple"> Pilih file</label>
                            <input type="file" name="logo" id="logo">
                        </div>
                        <button type="button" class="btn btn-primary" onclick="change_logo('{{ (($cafe != NULL) ? $cafe->id : '') }}')" id="btn-avt">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="uploadCover">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Upload Foto</h4>
                </div>
                <div class="modal-body">
                    <form id="updateAvatar">
                        <div class="form-group">
                            <label for="avatar" class="text-quadruple"> Pilih file</label>
                            <input type="file" name="cover" id="cover">
                        </div>
                        <button type="button" class="btn btn-primary" onclick="change_cover('{{ (($cafe != NULL) ? $cafe->id : '') }}')" id="btn-avt">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
	<style>
		.container-fluid > .row > [class*=col-]{
			padding-left: 5px;
			padding-right: 5px;
		}

		.panel{
			padding-left: 10px;
			padding-right: 10px;
		}

		.panel-title{
			color:#AAA;
			margin-bottom: 20px;
		}

		.btn-xs{
			padding: 3px 10px;
		}

		.radio-inline{
			border: 1px #AAA solid;
			border-radius: 10px;
			padding: 3px 10px 3px 25px;
		}
	</style>
@endsection

@section('javascripts')
    <script>
        var base_url = '{{ url('/') }}';
        var token = $('meta[name="csrf-token"]').attr('content');

        function ajax_config() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });
        }

        function change_logo(id) {

            var formData = new FormData();
            formData.append('logo', $('#logo')[0].files[0]);

            ajax_config();

            $.ajax({
                url: base_url+'/logo/replace/'+id,
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "JSON",
                success: function(data, status){
                    if (data.status) {
                        alert(data.status);
                        location.reload(true);
                    }else{
                        alert('shet');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('error');
                }
            });
        }
        function change_cover(id) {

            var formData = new FormData();
            formData.append('cover', $('#cover')[0].files[0]);

            ajax_config();

            $.ajax({
                url: base_url+'/cover/replace/'+id,
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "JSON",
                success: function(data, status){
                    if (data.status) {
                        alert(data.status);
                        location.reload(true);
                    }else{
                        alert('shet');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('error');
                }
            });
        }

    </script>
@endsection