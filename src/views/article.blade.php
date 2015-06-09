@extends(config('admin.views.post', config('admin.post.view', 'layouts.master')))

@section('content')

	<div class="page-content">
		{!! $post->body !!}
	</div>

@endsection
