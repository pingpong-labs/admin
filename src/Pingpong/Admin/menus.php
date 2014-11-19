<?php

Menu::create('admin-menu', function ($menu)
{
    $menu->route('admin.home', 'Home');
    $menu->dropdown('Articles', function ($sub)
    {
        $sub->route('admin.articles.index', 'All Articles');
        $sub->route('admin.articles.create', 'Add New');
        $sub->divider();
        $sub->route('admin.categories.index', 'Categories');
    });
    $menu->dropdown('Pages', function ($sub)
    {
        $sub->route('admin.pages.index', 'All Pages');
        $sub->route('admin.pages.create', 'Add New');
    });
    $menu->dropdown('Users', function ($sub)
    {
        $sub->route('admin.users.index', 'All Users');
        $sub->route('admin.users.create', 'Add New');
        $sub->divider();
        $sub->route('admin.roles.index', 'Roles');
        $sub->route('admin.permissions.index', 'Permissions');
    });
});

Menu::create('admin-menu-right', function ($menu)
{
    $menu->setPresenter('Pingpong\Admin\Presenters\NavbarRight');

    $name = isset(Auth::user()->name) ? Auth::user()->name : 'Preferences';

    $menu->dropdown($name, function ($sub)
    {
        $sub->route('admin.settings', 'Settings');
        $sub->divider();
        $sub->route('admin.logout', 'Logout');
    });
});