@extends($layout)

@section('content-header')
	<h1>
		All Roles ({!! $roles->count() !!})
		&middot;
		<small>{!! link_to_route('admin.roles.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')

	<table class="table">
		<thead>
			<th>No</th>
			<th>Name</th>
			<th>Alias</th>
			<th>Description</th>
			<th>Permissions</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($roles as $role)
			<tr>
				<td>{!! $no !!}</td>
				<td>{!! $role->name !!}</td>
				<td>{!! $role->slug !!}</td>
				<td>{!! $role->description !!}</td>
				<td>
					@foreach($role->permissions as $permission)
						&bullet; {!! $permission->name !!}<br>
					@endforeach
				</td>
				<td>{!! $role->created_at !!}</td>
				<td class="text-center">
					<a href="{!! route('admin.roles.edit', $role->id) !!}">Edit</a>
					&middot;
					@include('admin::partials.modal', ['data' => $role, 'name' => 'roles'])
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>

	<div class="text-center">
		{!! pagination_links($roles) !!}
	</div>
@stop
