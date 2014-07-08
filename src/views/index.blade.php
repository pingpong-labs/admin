@extends('admin::layouts.master')

@section('content')

<h3 class="page-header admin-header">Hello, {{ Auth::user()->name }}.</h3>

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-admin">
			<div class="panel-heading">
				Users
			</div>
			<table class="table">
				<tr>
					<td>All Users</td>
					<td>{{ User::count() }}</td>
				</tr>
				@foreach(Role::all() as $role)
				<tr>
					<td>{{ Str::plural($role->name) }}</td>
					<td>{{ Pingpong\Admin\Entities\User::hasRole($role->slug)->count() }}</td>
				</tr>
				@endforeach
			</table>
		</div>

	</div>
	<div class="col-md-6">
		<div class="panel panel-admin">
			<div class="panel-heading">
				Visitors
			</div>
			<table class="table">
				<tr>
					<td>Total Hits</td>
					<td>{{ Pingpong\Admin\Entities\Visitor::getTotalHits() }}</td>
				</tr>
				<tr>
					<td>Page Hits Today </td>
					<td>{{ Pingpong\Admin\Entities\Visitor::getHitsToday() }}</td>
				</tr>
				<tr>
					<td>Online Users</td>
					<td>{{ Pingpong\Admin\Entities\Visitor::getOnlineUsers() }}</td>
				</tr>
				<tr>
					<td>Total Visitors Today</td>
					<td>{{ Pingpong\Admin\Entities\Visitor::getTotalVisitorsToday() }}</td>
				</tr>
			</table>
		</div>

	</div>
	
</div>

@endsection

@section('style')
	<style type="text/css">
	td{
		widtd:50px;
	}
	td{
		text-indent: 10px;
	}
	</style>
@stop