@extends('_layout.dashboard.index')
@section('page_title', 'Tambah Informasi')
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
                    <h3 class="panel-title">{{ (isset($info)) ? 'Sunting' : 'Tambah' }} Menu</h3>
                </div>
                <div class="panel-body">
                    <form action="@if(isset($info)) {{url('info/'.$info->id)}} @else {{url('info')}} @endif" method="POST" enctype="multipart/form-data">
                        @if(isset($info)) {{ method_field('PATCH') }} @endif
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="1">
                        <small for="nb" style="color: red">* Isi Salah Satu</small>
                        <br>
                        <div class="form-group">
                            <label for="name">Judul Informasi</label>
                            <input type="text" class="form-control" name="title" placeholder="Isikan Judul Informasi" value="{{ isset($info) ? $info->title : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Isikan Informasi <span style="color: red">*</span></label>
                            <textarea name="body" class="form-control" rows="5">{{ isset($info) ? $info->body : ''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="part">Bagian</label>
                            <select name="part" id="part" class="form-control">
                                <option value="">Pilih Bagian Informasi</option>
                                @foreach($part as $key => $value)
                                    <option value="{{$key}}" {{ isset($info) && $info->part == $key ? 'selected' : ''}}>{{ $value }}</option>
                                @endforeach
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