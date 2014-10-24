@extends('admin::layouts.master')

@section('content')
	
	<h4 class="page-header">
		Edit
		&middot;
		@if(isOnPages())
		<small>{{ link_to_route('admin.pages.index', 'Back') }}</small>
		@else
		<small>{{ link_to_route('admin.articles.index', 'Back') }}</small>
		@endif
	</h4>

	<div>
		@include('admin::articles.form', array('model' => $article))
	</div>

@stop