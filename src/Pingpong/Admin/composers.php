<?php

View::composer('admin::articles.form', 'Pingpong\Admin\Composers\ArticleFormComposer');

View::composer('admin::users.form', 'Pingpong\Admin\Composers\UserFormComposer');

View::composer('admin::roles.form', 'Pingpong\Admin\Composers\RoleFormComposer');

View::composer('admin::settings', 'Pingpong\Admin\Composers\SettingFormComposer');