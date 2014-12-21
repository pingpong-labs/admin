@extends('admin::layouts.master')

@section('content-header')
	@if( ! isOnPages())
	<h1>
		All Articles ({{ $articles->getTotal() }})
		&middot;
		<small>{{ link_to_route('admin.articles.create', 'Add New') }}</small>
	</h1>
	@else
	<h1>
		All Pages ({{ $articles->getTotal() }})
		&middot;
		<small>{{ link_to_route('admin.pages.create', 'Add New') }}</small>
	</h1>
	@endif
@stop

@section('content')

	<table class="table">
		<thead>
			<th>No</th>
			<th>Title</th>
			<th>Author</th>
			@if( ! isOnPages())
			<th>Category</th>
			@endif
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($articles as $article)
			<tr>
				<td>{{ $no }}</td>
				<td>{{ $article->title }}</td>
				<td>{{ $article->user->name }}</td>
				@if( ! isOnPages())
				<td>{{ $article->category ? $article->category->name : null }}</td>
				@endif
				<td>{{ $article->created_at }}</td>
				<td class="text-center">
					@if(isOnPages())
						<a href="{{ route('admin.pages.edit', $article->id) }}">Edit</a>
						&middot;
						@include('admin::partials.modal', ['data' => $article, 'name' => 'pages'])
					@else
						<a href="{{ route('admin.articles.edit', $article->id) }}">Edit</a>
						&middot;
						@include('admin::partials.modal', ['data' => $article, 'name' => 'articles'])
					@endif
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>

	<div class="text-center">
		{{ pagination_links($articles) }}
	</div>
@stop