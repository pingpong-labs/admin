@extends('admin::layouts.master')

@section('content')

<!-- Nav tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#home" data-toggle="tab">General</a></li>
	<li><a href="#social" data-toggle="tab">Social Media</a></li>
	<li><a href="#seo" data-toggle="tab">SEO</a></li>
	<li><a href="#analytics" data-toggle="tab">Analytics</a></li>
	<li><a href="#account" data-toggle="tab">Developers</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<div class="tab-pane active" id="home">
		<h3></h3>
		{{ Form::open() }}
			<div class="form-group">
				{{ Form::label('site_name', 'Site Name:') }}
				{{ Form::text('site_name', option('site.name'), ['class' => 'form-control']) }}
				{{ $errors->first('site_name', '<div class="text-danger">:message</div>') }}
			</div>
			<div class="form-group">
				{{ Form::label('site.slogan', 'Slogan:') }}
				{{ Form::text('site.slogan', option('site.slogan'), ['class' => 'form-control']) }}
				{{ $errors->first('site.slogan', '<div class="text-danger">:message</div>') }}
			</div>
			<div class="form-group">
				{{ Form::label('site.description', 'Description:') }}
				{{ Form::textarea('site.description', option('site.description'), ['class' => 'form-control']) }}
				{{ $errors->first('site.description', '<div class="text-danger">:message</div>') }}
			</div>
			<div class="form-group">
				{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
			</div>
		{{ Form::close() }}
	</div> 
	<div class="tab-pane" id="account">
		<h3></h3>
		{{ Form::open() }}
			<div class="form-group">
				{{ Form::label('ckfinder.prefix', 'CKFinder Prefix Path:') }}
				{{ Form::text('ckfinder.prefix', option('ckfinder.prefix'), ['class' => 'form-control']) }}
				{{ $errors->first('ckfinder.prefix', '<div class="text-danger">:message</div>') }}
			</div>
			<div class="form-group">
				{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
			</div>
		{{ Form::close() }}
	</div>
	<div class="tab-pane hidden" id="messages">
		<h3></h3>
		<p class="hidden">
			{{ modal_popup(route('admin.reset'), 'Reset Database', 'Anda yakin ingin me-reset ulang database website ini ?')}}
		</p>
		<p>
			{{ modal_popup(route('admin.reinstall'), 'Reinstall Website', 'Anda yakin ingin menginstall ulang website ini ?')}}
		</p>
		<p>
			{{ modal_popup(route('admin.cache.clear'), 'Clear Cache', 'Anda yakin ingin menghapus cache?')}}
		</p>
	</div>
	<div class="tab-pane" id="seo">
		<h3></h3>
		{{ Form::open() }}
			<div class="form-group">
				{{ Form::label('site.keywords', 'Keyword:') }}
				{{ Form::text('site.keywords', option('site.keywords'), ['class' => 'form-control']) }}
				{{ $errors->first('site.keywords', '<div class="text-danger">:message</div>') }}
			</div>
			<div class="form-group">
				{{ Form::label('post.permalink', 'Post Permalink:') }}
				{{ Form::text('post.permalink', option('post.permalink'), ['class' => 'form-control']) }}
				{{ $errors->first('post.permalink', '<div class="text-danger">:message</div>') }}
				<p class="help-block">Permalink URL for article or page.</p>
			</div>
			<div class="form-group">
				{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
			</div>
		{{ Form::close() }}
	</div>
	<div class="tab-pane" id="social">
		<h3></h3>
		{{ Form::open() }}
			<div class="form-group">
				{{ Form::label('facebook.link', 'Facebook Link:') }}
				{{ Form::text('facebook.link', option('facebook.link'), ['class' => 'form-control']) }}
				{{ $errors->first('facebook.link', '<div class="text-danger">:message</div>') }}
			</div>
			<div class="form-group">
				{{ Form::label('twitter.link', 'Twitter Link:') }}
				{{ Form::text('twitter.link', option('twitter.link'), ['class' => 'form-control']) }}
				{{ $errors->first('twitter.link', '<div class="text-danger">:message</div>') }}
			</div>
			<div class="form-group">
				{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
			</div>
		{{ Form::close() }}
	</div>
	<div class="tab-pane" id="analytics">
		<h3></h3>
		{{ Form::open() }}
			<div class="form-group">
				{{ Form::label('tracking', 'Tracking Script:') }}
				{{ Form::textarea('tracking', option('tracking'), ['class' => 'form-control']) }}
				{{ $errors->first('tracking', '<div class="text-danger">:message</div>') }}
			</div>
			<div class="form-group">
				{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
			</div>
		{{ Form::close() }}
	</div>
</div>

@stop	