@extends(Config::get('admin::admin.template'))

@section('main')
	
	<h4 class="page-header">
		{{ $resource['title']['show'] }}
	</h4>

	<a href="{{ url('admin/'. Request::segment(2)) }}" class="btn btn-add-new btn-delete btn-default">
		<i class="glyphicon glyphicon-arrow-left"></i> Back
	</a>

	<table class="table table-bordered">
		@foreach ($resource['fields']['format'] as $key => $value)
		<tr>
			<th width="20%">
				@if(is_array($value))
					{{ $value[0] }}
				@else
					{{ $value }}
				@endif
			</th>
			<td>
				@if(is_array($value))
					{{ call_user_func_array($value[1], [$data->$key]) }}
				@else
					{{ $data->$key }}
				@endif
			</td>
		</tr>
		@endforeach
		<tr>
			<th>Action</th>
			<td>
				<a href="{{ URL::full() }}/edit" class="btn btn-default">
					<i class="glyphicon glyphicon-edit"></i>
				</a>
				<a href="#" data-form-id="#form{{$data->id}}" class="btn btn-delete btn-default">
					<i class="glyphicon glyphicon-trash"></i>
				</a>
				{{
					Form::open(array(
							'url'	=> URL::full(),
							'method'=>	'DELETE',
							'id'	=>	'form' . Request::segment(3)
						)
					)
				}}
				{{ Form::close() }}
			</td>
		</tr>
	</table>

@endsection