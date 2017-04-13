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
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">{{ $categories[0]['name'] }}</h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body table-responsive table-full">
                    <table class="table table-hover" id="menus">
                        @foreach($menus as $menu)
                            <tr onclick="addToCheck()" id="tr-menu" class="tr-selection text-quintuple">
                                <td width="150px"><img src="{{url("menus/showThumbnail/$menu->id")}}"
                                                       class="img img-responsive" style="width: 150px;" alt="">
                                </td>
                                <td>
                                    {{ strtoupper($menu->name) }}
                                </td>
                                <td class="price">
                                    Rp. {{ $menu->price }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-4">
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
@endsection

@section('styles')
    <style>
        .price {
            font-weight:bold;
        }
    </style>
@endsection

@section('javascripts')
    <script>
        function showMenus(idCategory) {
            $.ajax({
                url: '/payment/getMenus/' + idCategory,
                dataType: 'json',
                success: function(response) {
                    var menus = $('#menus').find('tbody').empty();
                    $.each(response.menus, function (i, menu) {
                        var id = menu.id;
                        var name = menu.name;
                        var price = menu.price;
                        var markup = "<tr onclick='addToCheck()' id='tr-menu' class='tr-selection text-quintuple'><td width='150px'><img src='"+getThumbnail(id)+"' class='img img-responsive' style='width: 150px;'></td><td>" + name + "</td><td class='price'>Rp. " + price + "</td></tr>";
                        console.log(markup);
                        $("#menus").find('tbody').append(markup);
                    });
                }
            });
        }

        function getThumbnail(idMenu) {
            return "http://gocafe.dev/menus/showThumbnail/" + idMenu;
        }
        function addToCheck() {
            alert('Added to Check')
        }
    </script>
@endsection