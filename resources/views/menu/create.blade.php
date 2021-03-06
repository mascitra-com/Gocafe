@extends('_layout/dashboard/index')
@section('page_title', 'Tambah Menu')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">var base_url = '{{ url()->full() }}'</script>
<script type="text/javascript">var target_url = '{{ Request::root().'/' }}'</script>
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-theme">
			<div class="panel-heading">
				<h3 class="panel-title">{{ (isset($menu)) ? 'Sunting' : 'Tambah' }} Menu</h3>
			</div>
			<div class="panel-body">
				<form action="@if(isset($menu)) {{ url('menus/'.$menu->id) }} @else {{ url('menus') }} @endif" method="POST" enctype="multipart/form-data">
				@if(isset($menu)) {{ method_field('PATCH') }} @endif
				{{ csrf_field() }}
					<div class="form-group">
						<label for="name">Nama Menu</label>
						<input type="text" class="form-control" name="name" placeholder="nama menu" value="{{ (isset($menu)) ? $menu->name : '' }}">
					</div>
					<div class="form-group">
						<label for="description">Deskripsi Menu</label>
						<textarea name="description" class="form-control" placeholder="deskripsi menu">{{ (isset($menu)) ? $menu->description : '' }}</textarea>
					</div>
					<div class="form-group">
                        <label for="category_id">Kategori Menu</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="category_name" placeholder="pilih kategori" value="{{ (isset($menu)) ? $menu->category->name : '' }}" readonly>
                            <input type="hidden" class="form-control" name="category_id" value="{{ (isset($menu)) ? $menu->category->id : '' }}">
                            <div class="span input-group-btn">
                                <button class="btn btn-default" data-toggle="modal" data-target="#kategori" role="dialog" type="button">pilih</button>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="price">Biaya Produksi</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp</span>
                                    <input type="text" class="form-control currency" name="cost" placeholder="harga menu" value="{{ (isset($menu)) ? $menu->cost : '' }}">
                                </div>
                            </div>
                        </div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="price">Harga Jual</label>
								<div class="input-group">
									<span class="input-group-addon">Rp</span>
									<input type="text" class="form-control currency" name="price" placeholder="harga menu" value="{{ (isset($menu)) ? $menu->price : '' }}">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="price">Status Halal</label>
                                <div class="radio" style="margin-left: .5em">
                                    <label>
                                        <input type="radio" name="halal" id="optionsRadios1" value="1" {{ (isset($menu) && $menu->halal) ? 'checked': '' }}>
                                        Halal
                                    </label>
                                </div>
                                <div class="radio" style="margin-left: .5em">
                                    <label>
                                        <input type="radio" name="halal" id="optionsRadios2" value="0" {{ (isset($menu) && !$menu->halal) ? 'checked': '' }}>
                                        Non-Halal
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="form-group break-20">
						<label for="images">Unggah foto</label>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-3">
								<input type="file" name="image1">
								<img src="{{ isset($menu) && $images[0] !== '/storage/default' ? url($images[0]) : URL::asset('images/blank-menu.png')}}" alt="thumbnail" class="image-preview">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3">
								<input type="file" name="image2">
								<img src="{{ isset($menu) && $images[1] !== '/storage/default' ? url($images[1]) : URL::asset('images/blank-menu.png')}}" alt="thumbnail" class="image-preview">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3">
								<input type="file" name="image3">
								<img src="{{ isset($menu) && $images[2] !== '/storage/default' ? url($images[2]) : URL::asset('images/blank-menu.png')}}" alt="thumbnail" class="image-preview">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3">
								<input type="file" name="image4">
								<img src="{{ isset($menu) && $images[3] !== '/storage/default' ? url($images[3]) : URL::asset('images/blank-menu.png')}}" alt="thumbnail" class="image-preview">
							</div>
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> simpan</button>
						<button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> bersihkan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="kategori">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Pilih kategori</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<input type="text" class="form-control" name="name" placeholder="nama kategori" id="category_name" list="recommended-category">
                    <datalist id="recommended-category">
						@if(isset($recommendedCat))
                            @foreach($recommendedCat as $recommend)
                                <option value="{{ $recommend->name }}">
                            @endforeach
                        @endif
                    </datalist>
				</div>
				<div class="form-group">
					<select name="colour" class="form-control" id="category_colour">
						<option value="" class="option-blank" selected>Pilih warna...</option>
						<option value="#C52B15" class="option-red">Merah</option>
						<option value="#337AB7" class="option-blue">Biru</option>
						<option value="#4AC5AE" class="option-green">Hijau</option>
						<option value="#F7C96B" class="option-yellow">Kuning</option>
						<option value="#BF73FF" class="option-purple">Ungu</option>
						<option value="#EF6C40" class="option-orange">Jingga</option>
						<option value="#FF7373" class="option-pink">Merah Muda</option>
						<option value="#CCC" class="option-grey">Abu-Abu</option>
						<option value="#333" class="option-black">Hitam</option>
					</select>
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block" onclick="addCategory()">Tambah Kategori</button>
				</div>
				<div class="table-responsive break-20">
					<table class="table table-stripped table-hover" id="tabel-kategori">
						<tbody id="category-list">
						@foreach($categories as $category)
							<tr>
								<td><i class="fa fa-circle" style="color:{{ $category->colour  }}"></i></td>
								<td>{{ $category->name }}</td>
								<td class="text-right">
									<button class="btn btn-primary btn-xs" data-kategori="{{ $category->name }}" data-kategoris="{{ $category->id }}" data-dismiss="modal" aria-label="Close">pilih kategori</button>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('styles')
<style>
	.image-preview{
		width: 150px;
		height: 150px;
		margin-top: 10px;
		object-fit: cover;
		object-position: center;
	}

	#tabel-kategori{
		border: 1px #CCC solid;
	}

	#tabel-kategori tbody td{
		border-top:1px #CCC solid;
		border-bottom:1px #CCC solid;
		vertical-align: middle;
	}

	#tabel-kategori tbody td:first-child{
		width: 10%;
		text-align: center;
	}

	select option{
		padding: 5px;
		font-weight: bold;
		color: #FFF;
	}

	.option-blank{background-color: #FFF;color: #333}
	.option-red{background-color: #C52B15;}
	.option-blue{background-color: #337AB7;}
	.option-green{background-color: #4AC5AE;}
	.option-yellow{background-color: #F7C96B;}
	.option-purple{background-color: #BF73FF;}
	.option-orange{background-color: #EF6C40;}
	.option-pink{background-color: #FF7373;}
	.option-grey{background-color: #CCC;}
	.option-black{background-color: #333;}

</style>
@endsection

@section('javascripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/df-number-format/2.1.6/jquery.number.min.js"></script>
    <script type="text/javascript" src="{{URL::asset('js/Category_Menu/category_menu.js')}}"></script>
<script>
    $('input.currency').number(true, 0, ',', '.');

    $("select[name='colour']").change(function(){
		if ($(this).val() != ""){
			$(this).css('background-color', $(this).val()).css('color', '#FFF');
		}else{
			$(this).css('background-color', '#FFF').css('color', '#333');
		}
	});

	$("#tabel-kategori > tbody > tr > td > button").click(function(){
		var data = $(this).data('kategori');
		var id = $(this).data('kategoris');
		$("input[name='category_name']").val(data);
		$("input[name='category_id']").val(id);
	});
</script>

@endsection