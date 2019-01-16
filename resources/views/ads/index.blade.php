@extends('_layout.dashboard.index')
@section('page_title', 'Manajemen Iklan')

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
                    <h3 class="panel-title text-24 text-grey pull-left">Manajemen Iklan</h3>
                    <div class="btn-group btn-group-sm pull-right" role="group">
                        <a class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh"></i></a>
                        <a href="{{ url('ads/create') }}" class="btn btn-default"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body table-responsive table-full">
                    <table class="table table-stripped table-hover">
                        <thead>
                            <th width="30%">Judul</th>
                            <th>Deskripsi</th>
                            <th width="20%">Bagian</th>
                            <th width="15%">Aksi</th>
                        </thead>
                        <tbody>
                        @if($ads)
                            @foreach($ads as $ad)
                                <tr>
                                    <td>{{ $ad->title }}</td>
                                    <td>{{ substr($ad->description, 0, 50) }}</td>
                                    <td>{{ isset($ad) && $ad->page == 1 ? 'Sponsor Utama' : (isset($ad) && $ad->page == 2 ? 'Sponsor Atas' : (isset($ad) && $ad->page == 3 ? 'Sponsor Bawah' : ''))}}</td>
                                    <td>
                                        <a href="{{ url("admin/ads/$ad->id/edit") }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ url("admin/ads/delete/$ad->id") }}" class="btn btn-sm btn-danger" onclick="return confirm('Anda Yakin Ingin Menghapus Informasi ini? Data tersebut tidak dapat di kembalikan lagi.')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <span class="panel-footer-text text-grey text-size-12 pull-left"><i class="fa fa-info-circle"></i> last edited at 01-11-2018 18:00</span>
                    <nav aria-label="Page navigation" class="pull-right">
                        <ul class="pagination pagination-sm">
                            <li>
                                <span aria-hidden="true">Show</span>
                            </li>
                            <li><a href="#">10</a></li>
                            <li><a href="#">50</a></li>
                            <li><a href="#">100</a></li>
                            <li>
                                <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
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
