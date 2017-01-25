@extends('layout/dashboard/index')
@section('page_title','Dashboard')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title pull-left"><i class="fa fa-archive fa-fw"></i> PANEL</h3>
				<div class="btn-group btn-group-sm pull-right" role="group">
					<button type="button" class="btn btn-default"><i class="fa fa-refresh"></i></button>
					<button type="button" class="btn btn-default"><i class="fa fa-archive"></i></button>
					<button type="button" class="btn btn-default"><i class="fa fa-file-word-o"></i></button>
				</div>
				<form action="#" class="pull-right">
					<div class="form-group">
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" placeholder="search">
							<span class="input-group-btn">
								<button class="btn btn-default"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</div>
				</form>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body table-responsive table-full">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>Status</th>
							<th>TTL</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>01</td>
							<td>Ainul Yaqin</td>
							<td>Jember</td>
							<td>Jomblo</td>
							<td>Bondowoso, 08 November 1992</td>
						</tr>
						<tr>
							<td>02</td>
							<td>Ainul Yaqin</td>
							<td>Jember</td>
							<td>Jomblo</td>
							<td>Bondowoso, 08 November 1992</td>
						</tr>
						<tr>
							<td>03</td>
							<td>Ainul Yaqin</td>
							<td>Jember</td>
							<td>Jomblo</td>
							<td>Bondowoso, 08 November 1992</td>
						</tr>
						<tr>
							<td>04</td>
							<td>Ainul Yaqin</td>
							<td>Jember</td>
							<td>Jomblo</td>
							<td>Bondowoso, 08 November 1992</td>
						</tr>
						<tr>
							<td>05</td>
							<td>Ainul Yaqin</td>
							<td>Jember</td>
							<td>Jomblo</td>
							<td>Bondowoso, 08 November 1992</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-download fa-fw"></i> PANEL A</h3>
			</div>
			<div class="panel-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam, minima quisquam architecto culpa, voluptates dignissimos quos possimus aut vel aperiam obcaecati harum error, aspernatur sunt quidem doloremque iste rem mollitia tempore eius atque. Rerum soluta quae, obcaecati quidem cumque magni tempore modi voluptas. Corporis incidunt, est necessitatibus architecto repudiandae optio impedit perferendis, quidem beatae similique ut perspiciatis tempore ipsa provident.</p>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-file-pdf-o fa-fw"></i> PANEL B</h3>
			</div>
			<div class="panel-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea quisquam doloremque dicta, consectetur ipsum necessitatibus quam temporibus, eveniet deleniti eligendi veritatis, sint tenetur autem ab dolorem blanditiis soluta eius maxime aut! Suscipit aliquid earum harum, quibusdam. Excepturi, perspiciatis minima voluptate explicabo aliquid consequuntur eum illum quam commodi! Accusamus ipsa quia vero autem porro pariatur reiciendis nisi culpa perferendis expedita. Quos?</p>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-users fa-fw"></i> PANEL C</h3>
			</div>
			<div class="panel-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea quisquam doloremque dicta, consectetur ipsum necessitatibus quam temporibus, eveniet deleniti eligendi veritatis, sint tenetur autem ab dolorem blanditiis soluta eius maxime aut! Suscipit aliquid earum harum, quibusdam. Excepturi, perspiciatis minima voluptate explicabo aliquid consequuntur eum illum quam commodi! Accusamus ipsa quia vero autem porro pariatur reiciendis nisi culpa perferendis expedita. Quos?</p>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-archive fa-fw"></i> PANEL</h3>
			</div>
			<div class="panel-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea quisquam doloremque dicta, consectetur ipsum necessitatibus quam temporibus, eveniet deleniti eligendi veritatis, sint tenetur autem ab dolorem blanditiis soluta eius maxime aut! Suscipit aliquid earum harum, quibusdam. Excepturi, perspiciatis minima voluptate explicabo aliquid consequuntur eum illum quam commodi! Accusamus ipsa quia vero autem porro pariatur reiciendis nisi culpa perferendis expedita. Quos?</p>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-archive fa-fw"></i> PANEL</h3>
			</div>
			<div class="panel-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea quisquam doloremque dicta, consectetur ipsum necessitatibus quam temporibus, eveniet deleniti eligendi veritatis, sint tenetur autem ab dolorem blanditiis soluta eius maxime aut! Suscipit aliquid earum harum, quibusdam. Excepturi, perspiciatis minima voluptate explicabo aliquid consequuntur eum illum quam commodi! Accusamus ipsa quia vero autem porro pariatur reiciendis nisi culpa perferendis expedita. Quos?</p>
			</div>
		</div>
	</div>
</div>
@endsection