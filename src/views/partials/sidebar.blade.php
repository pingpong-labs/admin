<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->gravatar() }}" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Hello, {{ Auth::user()->name }}</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i
                        class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="active">
                    <a href="{{ route('admin.home') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>Articles</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.articles.index') }}"><i class="fa fa-angle-double-right"></i> All Articles</a></li>
                        <li><a href="{{ route('admin.articles.create') }}"><i class="fa fa-angle-double-right"></i> Add New</a></li>
                        <li><a href="{{ route('admin.categories.index') }}"><i class="fa fa-angle-double-right"></i> Categories</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-flag"></i>
                        <span>Pages</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.pages.index') }}"><i class="fa fa-angle-double-right"></i> All Pages</a></li>
                        <li><a href="{{ route('admin.pages.create') }}"><i class="fa fa-angle-double-right"></i> Add New</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span>Users</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.users.index') }}"><i class="fa fa-angle-double-right"></i> All Users</a></li>
                        <li><a href="{{ route('admin.users.create') }}"><i class="fa fa-angle-double-right"></i> Add New</a></li>
                        <li><a href="{{ route('admin.roles.index') }}"><i class="fa fa-angle-double-right"></i> Roles</a></li>
                        <li><a href="{{ route('admin.permissions.index') }}"><i class="fa fa-angle-double-right"></i> Permissions</a></li>
                    </ul>
                </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>