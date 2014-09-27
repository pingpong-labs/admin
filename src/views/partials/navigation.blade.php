    <!-- Navigation -->
    <nav class="navbar navbar-admin navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand brand-logo" href="{{ url('/') }}" target="_blank">
                Administrator
            </a>
        </div>
        <!-- Top Menu Items -->
        {{ menu('admin.top', 'NavbarRight') }}

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        {{ menu('admin.sidebar', 'Sidebar') }}
    </nav>