@extends('admin::layouts.master')

@section('content')
	@if( ! isOnPages())
	<h4 class="page-header">
		All Articles ({{ $articles->getTotal() }})
		&middot;
		<small>{{ link_to_route('admin.articles.create', 'Add New') }}</small>
	</h4>
	@else
	<h4 class="page-header">
		All Pages ({{ $articles->getTotal() }})
		&middot;
		<small>{{ link_to_route('admin.pages.create', 'Add New') }}</small>
	</h4>
	@endif

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
					<a href="{{ route('admin.articles.edit', $article->id) }}">Edit</a>
					&middot;
					@if(isOnPages())
						@include('admin::partials.modal', ['data' => $article, 'name' => 'pages'])
					@else
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