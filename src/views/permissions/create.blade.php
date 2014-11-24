@extends('admin::layouts.master')


@section('content-header')
	
	<h1>
		Add New
		&middot;
		<small>{{ link_to_route('admin.permissions.index', 'Back') }}</small>
	</h1>
	
@stop
@section('content')
	
	<div>
		@include('admin::permissions.form')
	</div>

@stop