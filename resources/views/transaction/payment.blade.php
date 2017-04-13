@extends('_layout/dashboard/index')
@section('page_title', 'Pembayaran')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">Pembayaran</h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body table-responsive table-full">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">Kategori</h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body table-responsive table-full">
                    <table class="table table-hover table-stripped table-bordered">
                        @foreach($categories as $category)
                            <tr onclick="showMenus('{{ $category->id }}')" id="tr-category" class="tr-selection">
                                <td class="text-quintuple">
                                    {{ strtoupper($category->name) }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-10">
            <div class="row">
                <div class="col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">{{ $categories[0]['name'] }}</h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body table-responsive table-full">
                            <table class="table table-hover" id="menus">
                                @foreach($menus as $menu)
                                    <tr onclick="addToCheck('{{ $menu->id }}')" id="tr-menu"
                                        class="tr-selection text-quintuple">
                                        <td width="150px"><img src="{{url("menus/showThumbnail/$menu->id")}}"
                                                               class="img img-responsive" style="width: 150px;" alt="">
                                        </td>
                                        <td>
                                            {{ strtoupper($menu->name) }}
                                        </td>
                                        <td class="price">
                                            Rp. {{ number_format($menu->price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Pembayaran</h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body table-responsive table-full">
                            <table class="table text-quintuple" id="bill">
                                <thead>
                                <tr>
                                    <th width="5%"></th>
                                    <th width="37.5%">Nama</th>
                                    <th width="27.5%">Jumlah</th>
                                    <th width="25%">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <table class="table text-quintuple" id="bill">
                            <tr>
                                <td style="font-weight: bold; font-size: 16px" colspan="2">Total Keseluruhan</td>
                                <td colspan="2" class="text-right"><label class="total price" for="price" style="font-size: 16px">Rp. 0</label></td>
                            </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .price {
            font-weight: bold;
            font-size: 13px;
        }

        .input-xs {
            height: 26px;
            padding: 2px 5px;
            font-size: 14px;
            line-height: 1.5; /* If Placeholder of the input is moved up, rem/modify this. */
            border-radius: 3px;
        }

        button.deleteMenu {
            background: Transparent no-repeat;
            border: none;
            cursor: pointer;
            overflow: hidden;
        }
    </style>
@endsection

@section('javascripts')
    <script src="{{ url('plugins/jquery/jquery.number.min.js') }}"></script>
    <script src="{{ url('js/payment.js') }}"></script>
@endsection