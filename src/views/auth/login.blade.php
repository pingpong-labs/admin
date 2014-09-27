@extends('admin::layouts.auth')

@section('content')

	<div class="col-md-4 col-md-offset-4 col-login">
        {{ Form::open() }}
            <h1 class="text-center">Login</h1>
            <hr/>
            @if(Session::has('error'))
               <div class="alert alert-danger">
                    {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
               </div>
            @endif
            <div class="form-group">
                {{ Form::label('username', 'Username:') }}
                {{ Form::text('username', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('password', 'Password:') }}
                {{ Form::password('password', ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::submit('Login', ['class' => 'btn btn-block btn-primary']) }}
            </div>
            <hr/>
            <a class="btn btn-block btn-default" href="{{ url('admin/register') }}">Register here</a>
        {{ Form::close() }}
    </div>

@stop