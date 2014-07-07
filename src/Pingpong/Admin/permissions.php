<?php

use Pingpong\Admin\Trusty\Facades\Trusty;

Trusty::setView('admin::403');

Trusty::registerPermissions();

Trusty::when(['admin/users', 'admin/users/*'], 'manage_users');
Trusty::when(['admin/pages', 'admin/pages/*'], 'manage_pages');
Trusty::when(['admin/articles', 'admin/articles/*'], 'manage_articles');
Trusty::when(['admin/categories', 'admin/categories/*'], 'manage_categories');
Trusty::when('admin/settings', 'manage_settings');