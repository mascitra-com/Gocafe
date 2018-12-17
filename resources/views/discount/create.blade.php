@extends('_layout/dashboard/index')
@section('page_title', 'Promosi')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-theme">
                <div class="panel-heading">
                    <h4 class="panel-title">Tambah Diskon</h4>
                </div>
                <form action="{{ url('discount') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nama Diskon"
                                           required/>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="value">Diskon (%)</label>
                                    <div class="input-group">
                                        <input type="number" name="value" min="1" max="100" class="form-control"
                                               required/>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Mulai</label>
                                    <input type="date" name="start_date" class="form-control"
                                           placeholder="Tanggal Mulai"/>
                                    <p class="help-block">* Kosongkan jika di mulai dari hari ini</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="expired_date">Tanggal Selesai</label>
                                    <input type="date" name="expired_date" class="form-control"
                                           placeholder="Tanggal Selesai"/>
                                    <p class="help-block">* Kosongkan jika ingin manual menonaktifkan promosi ini</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" name="description"
                                      placeholder="Diskripsi Diskon"></textarea>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                </form>
            </div>
        </div>
        {{--<div class="col-xs-12 col-md-6">--}}
        {{--<div class="panel panel-theme">--}}
        {{--<div class="panel-heading">--}}
        {{--<div class="input-group">--}}
        {{--<input type="text" id="data" list="data-list" class="form-control"--}}
        {{--placeholder="choose menu" autocomplete="off">--}}
        {{--<datalist id="data-list">--}}
        {{--@foreach($menus as $menu)--}}
        {{--<option id="{{ $menu->id }}" value="{{ $menu->name }}"/>--}}
        {{--@endforeach--}}
        {{--</datalist>--}}
        {{--<span class="input-group-btn">--}}
        {{--<button class="btn btn-default btn-tambah" type="button"><i class="fa fa-plus"></i></button>--}}
        {{--</span>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="panel-body table-full table-responsive">--}}
        {{--<table class="table table-striped table-menu">--}}
        {{--<tbody>--}}
        {{--<tr>--}}
        {{--<td width="7%">01</td>--}}
        {{--<td>Menu A</td>--}}
        {{--<td class="text-right">--}}
        {{--<button type="button" class="btn btn-xs btn-default"><i class="fa fa-times text-red"></i>--}}
        {{--</button>--}}
        {{--</td>--}}
        {{--</tr>--}}
        {{--</tbody>--}}
        {{--</table>--}}
        {{--</div>--}}
        {{--<div class="panel-footer"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>
@endsection

@section('javascripts')
    {{-- UNCOMMENT JIKA DIBUTUHKAN NANTI
    <script type="text/javascript">
        var data = [];
        function refresh() {
            $(".table-menu > tbody").empty();
            data.forEach(function (item, index) {
                var html = "<tr><td width='7%'>" + (index + 1) + "</td><td>"+ item + "</td>";
                html += "<td class='text-right'><button type='button' class='btn btn-xs btn-default'><i class='fa fa-times text-red'></i></button></td></tr>";
                $(".table-menu > tbody").append(html);
            });
        }

        $('.btn-tambah').click(function(){
            $input = $("input[list='data-list']").val();
            if ($input) {
                data.push($input);
                refresh();
            }else{
                alert('Pilih menu terlebih dahulu!');
            }
        });
    </script> --}}
@stop