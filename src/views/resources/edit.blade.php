@extends(Config::get('admin::admin.template'))

@section('main')
	
	<h4 class="page-header">Edit Data</h4>
	{{
		Form::model($data, array(
				'url'		=> 	str_replace('/edit','',URL::full()),
				'method'	=>	'PATCH'
			)
		)
	}}
	<?php
	$form = $resource['form']['update'];
	if($form == 'auto')
	{
		$form = $resource['form']['create'];
	} 
	?>
	@foreach ($form as $name => $options)
	
	<div class="form-group">
		{{ Form::label($name, $options['title']) }}
		{{ Resource::form($name, $options['field']) }}
	</div>
	
	@endforeach

	<div class="form-group">
		<button type="submit" class="btn btn-danger">
			Submit
		</button>
		<a href="{{ url('admin/'. Request::segment(2)) }}" class="btn btn-default">Cancel</a>
	</div>

	{{ Form::close() }}

@endsection
