@extends('admin::layouts.master')


@section('content-header')
	
	<h1>
		Edit
		&middot;
		<small>{{ link_to_route('admin.roles.index', 'Back') }}</small>
	</h1>
@stop

@section('content')
	
	<div>
		@include('admin::roles.form', array('model' => $role) + compact('permission_role'))
	</div>

@stop