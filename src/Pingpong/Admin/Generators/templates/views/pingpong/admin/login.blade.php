@extends('pingpong.admin.template')

@section('main')
<div class="container">
    <div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h2 class="panel-title">
			    		<i class="glyphicon glyphicon-lock"></i>
			    		Sign in
			    	</h2>
			 	</div>
			  	<div class="panel-body">

					@if(Session::has('message-success'))
						<div class="alert alert-message alert-success">
							<i class="glyphicon glyphicon-info-sign"></i>
							{{ Session::get('message-success') }}
						</div>
					@elseif(Session::has('message-error'))
						<div class="alert alert-message alert-danger">
							<i class="glyphicon glyphicon-info-sign"></i>
							{{ Session::get('message-error') }}
						</div>
					@elseif(Session::has('message-warning'))
						<div class="alert alert-message alert-warning">
							<i class="glyphicon glyphicon-info-sign"></i>
							{{ Session::get('message-warning') }}
						</div>
					@endif
					
			    	{{
			    		Form::open(array(
			    				'url'	=> URL::full()
			    			)
			    		)
			    	}}
                    <fieldset>
			    	  	<div class="form-group">
			    	  		{{ Form::text('username', null, ['class'=>'form-control','placeholder'=>'Username',]) }}
			    		</div>
			    		<div class="form-group">			    		
			    	  		{{ Form::password('password', ['class'=>'form-control','placeholder'=>'Username',]) }}
			    		</div>
		    	    	<label class="checkbox">
			    	  		{{ Form::checkbox('remember', '1', false, [ 'class'=>"label-remember"]) }}
	    	    			Remember Me
		    	    	</label>
			    		<input class="btn btn-danger btn-block" type="submit" value="Sign in">
			    	</fieldset>
			      	{{ Form::close() }}
			    </div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('style')

<style type="text/css">
	.vertical-offset-100{
	    padding-top:100px;
	}
	.label-remember{
		top: -1px;
		position: relative;
	}
</style>

@endsection

@endsection