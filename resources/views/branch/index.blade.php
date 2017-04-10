@extends('_layout/dashboard/index')
@section('page_title', 'Cafe Branches')

@section('content')
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
    <div class="content-title">Branches Management</div>
    <div class="row break-20">
        <div class="col-xs-12 nopadding">
            <div class="panel panel-theme">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">Branches</h3>
                    <div class="btn-group btn-group-sm pull-right" role="group">
                        <a class="btn btn-default" href="#"><i class="fa fa-fw fa-refresh"></i> <span class="hidden-sm">Refresh</span></a>
                        <button class="btn btn-default" data-toggle="modal" data-target="#add-branches"><i
                                    class="fa fa-fw fa-plus"></i> <span class="hidden-sm">New</span></button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body table-responsive table-full">
                    <table class="table table-stripped">
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
                                <td class="text-right"><a href="{{ url('branch/'.$branch->id.'/edit') }}" class="btn btn-xs btn-default"><i class="fa fa-info-circle fa-fw"></i> detail</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="add-branches">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Branches</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url("branch") }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Location</label>
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <select name="province_id" class="form-control" id="provinces">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <select name="city_id" class="form-control" id="cities">
                                        <option value="">Pilih Kabupaten / Kota</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <select name="district_id" class="form-control" id="districts">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea name="address" class="form-control" placeholder="Branch address"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control" name="phone" placeholder="phone number">
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Open Hours</label>
                                    <input type="text" class="form-control" name="open_hours" placeholder="open hours">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Close Hours</label>
                                    <input type="text" class="form-control" name="close_hours"
                                           placeholder="close hours">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary"><i class="fa fa-save fa-fw"></i> save</button>
                            <button class="btn btn-default"><i class="fa fa-refresh fa-fw"></i> reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    <script type="text/javascript" src="{{URL::asset('js/branches.js')}}"></script>
@endsection