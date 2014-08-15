@extends('admin::layouts.login')

@section('content')

    <div style="margin-top: 100px;"></div>
    <div class="col-md-4 col-md-offset-4">
     	{{ Form::open(['route' => 'admin.login.store']) }}
            <legend>
                Login
            </legend>
            <div class="form-group">
                {{ Form::label('username', 'Username:') }}
                {{ Form::text('username', null, ['class' => 'form-control']) }}
                {{ $errors->first('username', '<div class="text-danger">:message</div>') }}
            </div>
            <div class="form-group">
                {{ Form::label('password', 'Password:') }}
                {{ Form::password('password', ['class' => 'form-control']) }}
                {{ $errors->first('password', '<div class="text-danger">:message</div>') }}
            </div>
            <div class="form-group">
                {{ Form::submit('Login', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close()}}
    </div>

@endsection