<nav class="navbar navbar-default navbar-admin navbar-static-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}" target="_blank">
        {{ option('site.name', 'Administrator') }}
      </a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      {{ Menu::get('admin-menu')}}
      <form class="navbar-form navbar-left" role="search">
        {{--<div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>--}}
      </form>
      {{ Menu::get('admin-menu-right') }}
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>