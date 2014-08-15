@extends('admin::layouts.master')

@section('content')
	
	<h4 class="page-header">
		Add New
		&middot;
		<small>{{ link_to_route('admin.roles.index', 'Back') }}</small>
	</h4>

	<div>
		@include('admin::roles.form')
	</div>

@stop