@extends('admin::layouts.master')

@section('content-header')
	<h1>
		Edit
		&middot;
		@if(isOnPages())
		<small>{{ link_to_route('admin.pages.index', 'Back') }}</small>
		@else
		<small>{{ link_to_route('admin.articles.index', 'Back') }}</small>
		@endif
	</h1>
@stop

@section('content')

	<div>
		@include('admin::articles.form', array('model' => $article))
	</div>

@stop