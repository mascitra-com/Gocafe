@extends('_layout/dashboard/index')
@section('page_title', 'UI List')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-fw fa-window-maximize"></i> List View</h3></div>
			<div class="panel-body table-responsive table-full">
				<table class="table table-hover table-striped table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama View</th>
							<th>Detail</th>
							<th>Link</th>
							<th class="text-center">Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>01</td>
							<td>List UI</td>
							<td>Menampilkan semua daftar tampilan yang sudah atau sedang dikerjakan (tidak ada hubungan dengan sistem)</td>
							<td><a class="btn btn-default btn-xs" href="#">ui</a></td>
							<td class="text-center"><i class="fa fa-circle text-green"></i></td>
						</tr>
						<tr>
							<td>02</td>
							<td>Profile Owner</td>
							<td>Halaman edit &amp menampilkan informasi owner</td>
							<td><a class="btn btn-default btn-xs" href="#">ui/profile</a></td>
							<td class="text-center"><i class="fa fa-circle text-green"></i></td>
						</tr>
						<tr>
							<td>03</td>
							<td>Profil Cafe</td>
							<td>Halaman edit &amp menampilkan informasi Cafe</td>
							<td><a class="btn btn-default btn-xs" href="#">ui/cafe</a></td>
							<td class="text-center"><i class="fa fa-circle text-green"></i></td>
						</tr>
						<tr>
							<td>04</td>
							<td>Staff</td>
							<td>Menampilkan daftar staff</td>
							<td><a class="btn btn-default btn-xs" href="#">ui/staff</a></td>
							<td class="text-center"><i class="fa fa-circle text-green"></i></td>
						</tr>
						<tr>
							<td>05</td>
							<td>Import Staff</td>
							<td>Halaman modal untuk mengimport data staff</td>
							<td><a class="btn btn-default btn-xs" href="#">ui/staff</a></td>
							<td class="text-center"><i class="fa fa-circle text-green"></i></td>
						</tr>
						<tr>
							<td>06</td>
							<td>Tambah Staff</td>
							<td>Halaman form untuk menambah staff baru</td>
							<td><a class="btn btn-default btn-xs" href="#">ui/staff/add</a></td>
							<td class="text-center"><i class="fa fa-circle text-green"></i></td>
						</tr>
						<tr>
							<td>07</td>
							<td>Detail Staff</td>
							<td>Halaman form untuk melihat detail staff sekaligus sebagai halaman edit</td>
							<td><a class="btn btn-default btn-xs" href="#">ui/staff/detail</a></td>
							<td class="text-center"><i class="fa fa-circle text-green"></i></td>
						</tr>
						<tr>
							<td>08</td>
							<td>Branches</td>
							<td>Menampilkan daftar branch cafe</td>
							<td><a class="btn btn-default btn-xs" href="#">ui/brach</a></td>
							<td class="text-center"><i class="fa fa-circle text-red"></i></td>
						</tr>
						<tr>
							<td>09</td>
							<td>Tambah brach</td>
							<td>Halaman form untuk menambah brach baru</td>
							<td><a class="btn btn-default btn-xs" href="#">ui/brach/add</a></td>
							<td class="text-center"><i class="fa fa-circle text-red"></i></td>
						</tr>
						<tr>
							<td>10</td>
							<td>Detail brach</td>
							<td>Halaman form untuk melihat detail brach sekaligus sebagai halaman edit</td>
							<td><a class="btn btn-default btn-xs" href="#">ui/brach/detail</a></td>
							<td class="text-center"><i class="fa fa-circle text-red"></i></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="panel-footer">
				<span><i class="fa fa-circle text-green"></i> Selesai</span>
				<span><i class="fa fa-circle text-orange"></i> On The Way</span>
				<span><i class="fa fa-circle text-red"></i> Belum</span>
			</div>
		</div>
	</div>
</div>
@endsection

@section('styles')
<style>

	.panel-footer span .fa{
		margin-right: 3px;
	}

	.panel-footer span{
		margin-right: 5px;
	}
</style>
@endsection