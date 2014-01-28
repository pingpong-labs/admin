@extends('admin::template')

@section('main')
	
	<h4 class="page-header">
		{{ sprintf($resource['title']['index'], $count) }}
	</h4>

<<<<<<< HEAD
	<div class="btn-add-new index col-lg-7">
=======
<<<<<<< HEAD
	<div class="btn-add-new index col-lg-7">
=======
	<div class="btn-add-new col-lg-5 col-md-5">
>>>>>>> 9915882e3f7d6642bffcb31c5bd1de414fd4d3dc
>>>>>>> 53a5123897370f9f62a4a5fefa48de54ea763d38
		<div class="form-search">
			{{
				Form::open(array(
						'url'	=> URL::to('admin/'.Request::segment(2).'/search')
					)
				)
			}}
			<div class="col-lg-8">
				<div class="input-group">
					{{ Form::text('search',null,[
								'class'			=>	'form-control',
								'placeholder'	=>	'Search',
								'required'		=>	'required'
							]
						)
					}}
					<span class="input-group-btn">
						<button class="btn btn-danger" type="submit">
							<i class="glyphicon glyphicon-search"></i>
						</button>
					</span>
				</div><!-- /input-group -->
			</div><!-- /.col-lg-6 -->
			{{ Form::close() }}	
		</div>
		<a class="btn btn-danger" href="{{ url('admin/'. Request::segment(2) .'/create' )}}"><i class="glyphicon glyphicon-plus-sign"></i> Add New</a>
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 53a5123897370f9f62a4a5fefa48de54ea763d38

		<!-- Single button -->
		<div class="btn-group">
			<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
				<i class="glyphicon glyphicon-asterisk"></i>
			</button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<li class="dropdown-header">
						<i class="glyphicon glyphicon-cloud-download"></i>
						Export As
					</li>
					<li>
						<a href="#">
							Excel Document
						</a>
					</li>
					<li>
						<a href="#">
							CSV Document
						</a>
					</li>
					<li>
						<a href="#">
							PDF Document
						</a>
					</li>
					<li class="dropdown-header">
						<i class="glyphicon glyphicon-cog"></i>
						Options
					</li>
					<li>
						<a href="#">
							<i class="glyphicon glyphicon-trash"></i>
							Empty
						</a>
					</li>
				</li>
			</ul>
		</div>
<<<<<<< HEAD
=======
=======
>>>>>>> 9915882e3f7d6642bffcb31c5bd1de414fd4d3dc
>>>>>>> 53a5123897370f9f62a4a5fefa48de54ea763d38
	</div>

	@if($count > 0)
		<table class="table table-bordered">
		<thead>
			{{ $heading }}
		</thead>
		<body>
		@foreach ($datas as $data)
<<<<<<< HEAD
			{{ Resource::fetch($data, $fields, $format) }}
=======
<<<<<<< HEAD
			{{ Resource::fetch($data, $fields, $format, $actions) }}
=======
			{{ Resource::fetch($data, $fields, $format) }}
>>>>>>> 9915882e3f7d6642bffcb31c5bd1de414fd4d3dc
>>>>>>> 53a5123897370f9f62a4a5fefa48de54ea763d38
		@endforeach
		</body>
		</table>
		{{ $datas->links() }}
	@else
	<div class="alert alert-info">
		<i class="glyphicon glyphicon-info-sign"></i>
		There are no data.
	</div>
	@endif

@endsection