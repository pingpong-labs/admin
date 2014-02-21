@extends(Config::get('admin::admin.template'))

@section('main')
	
	<h4 class="page-header">
		{{ $resource['title']['show'] }}
	</h4>

	<a href="{{ url('admin/'. Request::segment(2)) }}" class="btn btn-add-new btn-delete btn-default">
		<i class="glyphicon glyphicon-arrow-left"></i> Back
	</a>

	<table class="table table-bordered">
		@foreach (Resource::getFields($resource['table']) as $field)
		<tr>
			<th width="20%">
				{{ Resource::th($resourceName, $field) }}
			</th>
			<td>
				{{ Resource::td($resourceName, $field, $data, array($data->id, $data)) }}				
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
