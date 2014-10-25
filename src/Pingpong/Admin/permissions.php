<?php

if (Auth::check())
{
    try
    {
        Trusty::registerPermissions();
    }
    catch (PDOException $e)
    {
        //
    }

    Trusty::when(['admin/users', 'admin/users/*'], 'manage_users');
    Trusty::when(['admin/pages', 'admin/pages/*'], 'manage_pages');
    Trusty::when(['admin/articles', 'admin/articles/*'], 'manage_articles');
    Trusty::when(['admin/categories', 'admin/categories/*'], 'manage_categories');
    Trusty::when(['admin/permissions', 'admin/permissions/*'], 'manage_permissions');
    Trusty::when(['admin/roles', 'admin/roles/*'], 'manage_roles');
    Trusty::when('admin/settings', 'manage_settings');
}