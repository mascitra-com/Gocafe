@extends('_layout.dashboard.index')
@section('page_title', 'Manajemen Informasi')

@section('content')
    <div class="row">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-xs-12">
            <div class="panel panel-theme">
                <div class="panel-heading">
                    <h3 class="panel-title text-24 text-grey pull-left">Manajemen Informasi</h3>
                    <div class="btn-group btn-group-sm pull-right" role="group">
                        <a class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh"></i></a>
                        <a href="{{ url('admin/info/create') }}" class="btn btn-default"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body table-responsive table-full">
                    <table class="table table-stripped table-hover">
                        <thead>
                            <th width="10%">Status</th>
                            <th width="30%">Judul</th>
                            <th>Deskripsi</th>
                            <th width="20%">Bagian</th>
                            <th width="15%">Aksi</th>
                        </thead>
                        <tbody>
                        @if($information)
                            @foreach($information as $info)
                                <tr>
                                    <td>
                                        @if(!$info->deleted_at)
                                            <a href="{{ url("admin/info/deactivate/$info->id")}}" class="label label-success">Aktif</a>
                                        @else
                                            <a href="{{ url("admin/info/activate/$info->id") }}" class="label label-danger">Nonaktif</a>
                                        @endif
                                    </td>
                                    <td>{{ $info->title }}</td>
                                    <td>{{ substr($info->body, 0, 50) }}</td>
                                    <td>{{ $info->part == 1 ? 'Kulinerae' : ($info->part == 2 ? 'Layanan Pelanggan' : ($info->part == 3 ? 'Fitur Seru Kami' : ''))}}</td>
                                    <td>
                                        <a href="{{ url("admin/info/$info->id/edit") }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ url("admin/info/destroy/$info->id") }}" class="btn btn-sm btn-danger" onclick="return confirm('Anda Yakin Ingin Menghapus Informasi ini? Data tersebut tidak dapat di kembalikan lagi.')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <span class="panel-footer-text text-grey text-size-12 pull-left"><i class="fa fa-info-circle"></i> last edited at 01/11/2018 18:00</span>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .table > tbody > tr > td{
            vertical-align: middle;
        }

        tr > td:first-child{
            width: 6%;
            text-align: center;
        }

        tr > td:first-child button{
            padding: 3px 5px;
        }

        ul.pagination{
            margin: 0;
        }
    </style>
@endsection
