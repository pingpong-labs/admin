@if(isOnPages())
	@if(isset($model))
	{{ Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.pages.update', $model->id]]) }}
	@else
	{{ Form::open(['files' => true, 'route' => 'admin.pages.store']) }}
	@endif
@else
	@if(isset($model))
	{{ Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.articles.update', $model->id]]) }}
	@else
	{{ Form::open(['files' => true, 'route' => 'admin.articles.store']) }}
	@endif
@endif
	<div class="form-group">
		{{ Form::label('title', 'Title:') }}
		{{ Form::text('title', null, ['class' => 'form-control']) }}
		{{ $errors->first('title', '<div class="text-danger">:message</div>') }}
	</div>
	<div class="form-group">
		{{ Form::label('slug', 'Slug:') }}
		{{ Form::text('slug', null, ['class' => 'form-control']) }}
		{{ $errors->first('slug', '<div class="text-danger">:message</div>') }}
	</div>
	@if(Request::is('admin/articles/create'))
	<div class="form-group">
		{{ Form::label('category_id', 'Category:') }}
		{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
		{{ $errors->first('category_id', '<div class="text-danger">:message</div>') }}
	</div>
	@else
	{{ Form::hidden('type', 'page') }}
	@endif
	<div class="form-group">
		{{ Form::label('body', 'Body:') }}
		{{ Form::textarea('body', null, ['class' => 'form-control', 'id' => 'ckeditor']) }}
		{{ $errors->first('body', '<div class="text-danger">:message</div>') }}
	</div>
	<div class="form-group">
		{{ Form::label('image', 'Image:') }}
		{{ Form::file('image', ['class' => 'form-control']) }}
		{{ $errors->first('image', '<div class="text-danger">:message</div>') }}
	</div>	
	@if(isset($model))
	<div class="form-group">
		@if($model->image)
		<img class="img-responsive" src="{{ asset('images/articles/' . $model->image) }}">
		@endif
	</div>
	@endif
	<div class="form-group">
		{{ Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) }}
	</div>
{{ Form::close() }}

@section('script')
	
	{{ script('vendor/ckeditor/ckeditor.js') }}
	{{ script('vendor/ckfinder/ckfinder.js') }}
	
	<script type="text/javascript">
		CKEDITOR.editorConfig = function( config ) {
			var prefix = '/{{ option("ckfinder.prefix") }}';

		   config.filebrowserBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html';
		   config.filebrowserImageBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html?type=Images';
		   config.filebrowserFlashBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html?type=Flash';
		   config.filebrowserUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
		   config.filebrowserImageUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
		   config.filebrowserFlashUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
		};

		var editor = CKEDITOR.replace( 'ckeditor' );
		var prefix = '/{{ option("ckfinder.prefix") }}';
		CKFinder.setupCKEditor( editor, prefix + '/vendor/ckfinder/') ;
	</script>
@stop