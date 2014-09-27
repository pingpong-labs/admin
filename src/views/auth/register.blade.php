@extends('admin::layouts.auth')

@section('content')

	<div class="col-md-4 col-md-offset-4 col-login">
        {{ Form::open() }}
            <h1 class="text-center">Create New Account</h1>
            <hr/>
            <div class="form-group">
                {{ Form::label('name', 'Name:') }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
                {{ error_for('name', $errors) }}
            </div>
            <div class="form-group">
                {{ Form::label('username', 'Username:') }}
                {{ Form::text('username', null, ['class' => 'form-control']) }}
                {{ error_for('username', $errors) }}
            </div>
            <div class="form-group">
                {{ Form::label('email', 'Email:') }}
                {{ Form::email('email', null, ['class' => 'form-control']) }}
                {{ error_for('email', $errors) }}
            </div>
            <div class="form-group">
                {{ Form::label('password', 'Password:') }}
                {{ Form::password('password', ['class' => 'form-control']) }}
                {{ error_for('password', $errors) }}
            </div>
            <div class="form-group">
                {{ Form::submit('Register', ['class' => 'btn btn-block btn-primary']) }}
            </div>
            <hr/>
            <a class="btn btn-block btn-default" href="{{ url('admin/login') }}">Login here</a>
        {{ Form::close() }}
    </div>

@stop