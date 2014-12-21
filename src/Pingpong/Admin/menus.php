<?php

Menu::create('admin-menu', function ($menu)
{
    $menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
    $menu->route('admin.home', 'Dashboard', [], ['icon' => 'fa fa-dashboard']);
    $menu->dropdown('Articles', function ($sub)
    {
        $sub->route('admin.articles.index', 'All Articles');
        $sub->route('admin.articles.create', 'Add New');
        $sub->divider();
        $sub->route('admin.categories.index', 'Categories');
    }, ['icon' => 'fa fa-book']);
    $menu->dropdown('Pages', function ($sub)
    {
        $sub->route('admin.pages.index', 'All Pages');
        $sub->route('admin.pages.create', 'Add New');
    }, ['icon' => 'fa fa-flag']);
    $menu->dropdown('Users', function ($sub)
    {
        $sub->route('admin.users.index', 'All Users');
        $sub->route('admin.users.create', 'Add New');
        $sub->divider();
        $sub->route('admin.roles.index', 'Roles');
        $sub->route('admin.permissions.index', 'Permissions');
    }, ['icon' => 'fa fa-users']);
});