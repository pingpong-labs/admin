@extends($layout)

@section('content-header')
	<h1>403 - Access Denied</h1>
@stop

@section('content')

	<div class="error-page">
	    <h2 class="headline text-info"> 403</h2>
	    <div class="error-content">
	        <h3><i class="fa fa-warning text-yellow"></i> Oops! Access Denied!</h3>
	        <p>
	             You don't have permission to access this page!
	        </p>
	        <form class='search-form'>
	            <div class='input-group'>
	                <input type="text" name="search" class='form-control' placeholder="Search"/>
	                <div class="input-group-btn">
	                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
	                </div>
	            </div><!-- /.input-group -->
	        </form>
	    </div><!-- /.error-content -->
	</div><!-- /.error-page -->

@endsection
