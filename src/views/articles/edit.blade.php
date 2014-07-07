@extends('admin::layouts.master')

@section('content')
	
	<h4 class="page-header">
		Edit
		&middot;
		<small>{{ link_to_route('admin.articles.index', 'Back') }}</small>
	</h4>

	<div>
		@include('admin::articles.form', array('model' => $article))
	</div>

@stop