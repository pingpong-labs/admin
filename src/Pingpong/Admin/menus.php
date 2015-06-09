<?php

Menu::create('admin-menu', function ($menu) {
    $menu->enableOrdering();
    $menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
    $menu->route('admin.home', 'Dashboard', [], 0, ['icon' => 'fa fa-dashboard']);
    $menu->dropdown('Articles', function ($sub) {
        $sub->route('admin.articles.index', 'All Articles', [], 1);
        $sub->route('admin.articles.create', 'Add New', [], 2);
        $sub->divider(3);
        $sub->route('admin.categories.index', 'Categories', [], 4);
    }, 1, ['icon' => 'fa fa-book']);
    $menu->dropdown('Pages', function ($sub) {
        $sub->route('admin.pages.index', 'All Pages', [], 1);
        $sub->route('admin.pages.create', 'Add New', [], 2);
    }, 2, ['icon' => 'fa fa-flag']);
    $menu->dropdown('Users', function ($sub) {
        $sub->route('admin.users.index', 'All Users', [], 1);
        $sub->route('admin.users.create', 'Add New', [], 2);
        $sub->divider(3);
        $sub->route('admin.roles.index', 'Roles', [], 4);
        $sub->route('admin.permissions.index', 'Permissions', [], 5);
    }, 3, ['icon' => 'fa fa-users']);
});
