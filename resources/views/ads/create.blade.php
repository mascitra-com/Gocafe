@extends('_layout.dashboard.index')
@section('page_title', 'Tambah Iklan')
@section('content')
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
                    <h3 class="panel-title">{{ (isset($ads)) ? 'Sunting' : 'Tambah' }} Iklan</h3>
                </div>
                <div class="panel-body">
                    <form action="@if(isset($ads)) {{url('admin/ads/'.$ads->id)}} @else {{url('admin/ads')}} @endif" method="POST" enctype="multipart/form-data">
                        @if(isset($ads)) {{ method_field('PATCH') }} @endif
                        {{ csrf_field() }}
                        <br>
                        <div class="form-group">
                            <label for="name">Judul Iklan</label>
                            <input type="text" class="form-control" name="title" placeholder="Isikan Judul Iklan" value="{{ isset($ads) ? $ads->title : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Isikan Iklan</label>
                            <textarea name="description" class="form-control" rows="5">{{ isset($ads) ? $ads->description : ''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Pilih Banner Iklan</label>
                            <input type="file" name="file">
                            @if(isset($ads))
                            <br><img src="{{ $banner }}" class="img-rounded img-responsive" alt="foto">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="type">Jenis</label>
                            <select name="page" id="page" class="form-control">
                                <option value="">Pilih Letak Iklan</option>
                                <option value="1" {{ isset($ads) && $ads->page == 1 ? 'selected' : ''}}>Sponsor Utama</option>
                                <option value="2" {{ isset($ads) && $ads->page == 2 ? 'selected' : ''}}>Sponsor Atas</option>
                                <option value="3" {{ isset($ads) && $ads->page == 3 ? 'selected' : ''}}>Sponsor Bawah</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Bersihkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection