@extends('admin::layouts.master')

@section('content')
	
	<h4 class="page-header">
		Edit
		&middot;
		<small>{{ link_to_route('admin.permissions.index', 'Back') }}</small>
	</h4>
	
	<div>
		@include('admin::permissions.form', array('model' => $permission))
	</div>

@stop