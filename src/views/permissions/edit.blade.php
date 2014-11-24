@extends('admin::layouts.master')

@section('content-header')
	
	<h1>
		Edit
		&middot;
		<small>{{ link_to_route('admin.permissions.index', 'Back') }}</small>
	</h1>
	
@stop

@section('content')
	
	<div>
		@include('admin::permissions.form', array('model' => $permission))
	</div>

@stop