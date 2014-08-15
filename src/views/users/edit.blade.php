@extends('admin::layouts.master')

@section('content')
	
	<h4 class="page-header">
		Edit
		&middot;
		<small>{{ link_to_route('admin.users.index', 'Back') }}</small>
	</h4>
	
	<div>
		@include('admin::users.form', array('model' => $user) + compact('role'))
	</div>

@stop