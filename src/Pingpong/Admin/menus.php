<?php

Menu::create('admin-menu', function ($menu) {
    $menu->enableOrdering();
    $menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
    $menu->route('admin.home', trans('admin.menus.dashboard'), [], 0, ['icon' => 'fa fa-dashboard']);
    $menu->dropdown(trans('admin.menus.articles.title'), function ($sub) {
        $sub->route('admin.articles.index', trans('admin.menus.articles.all'), [], 1);
        $sub->route('admin.articles.create', trans('admin.menus.articles.create'), [], 2);
        $sub->divider(3);
        $sub->route('admin.categories.index', trans('admin.menus.categories'), [], 4);
    }, 1, ['icon' => 'fa fa-book']);
    $menu->dropdown(trans('admin.menus.pages.title'), function ($sub) {
        $sub->route('admin.pages.index', trans('admin.menus.pages.all'), [], 1);
        $sub->route('admin.pages.create', trans('admin.menus.pages.create'), [], 2);
    }, 2, ['icon' => 'fa fa-flag']);
    $menu->dropdown(trans('admin.menus.users.title'), function ($sub) {
        $sub->route('admin.users.index', trans('admin.menus.users.all'), [], 1);
        $sub->route('admin.users.create', trans('admin.menus.users.create'), [], 2);
        $sub->divider(3);
        $sub->route('admin.roles.index', trans('admin.menus.roles'), [], 4);
        $sub->route('admin.permissions.index', trans('admin.menus.permissions'), [], 5);
    }, 3, ['icon' => 'fa fa-users']);
});
