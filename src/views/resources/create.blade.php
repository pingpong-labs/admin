<<<<<<< HEAD
@extends(Config::get('admin::admin.template'))
=======
@extends('admin::template')
>>>>>>> 9915882e3f7d6642bffcb31c5bd1de414fd4d3dc

@section('main')
	
	<h4 class="page-header">
		{{ $resource['title']['create'] }}
	</h4>
	{{
		Form::open(array(
				'url'	=> URL::to('admin/'. Request::segment(2))
			)
		)
	}}
		
		@foreach ($resource['form']['create'] as $name => $options)
		
		<div class="form-group">
			{{ Form::label($name, $options['title']) }}
			{{ Resource::form($name, $options['field']) }}
			{{ $errors->first($name, '<div class="text-danger">:message</div>')}}
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