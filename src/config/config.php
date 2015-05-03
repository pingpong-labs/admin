<?php

return [
    'filter' => [
        'auth' => 'admin.auth',
        'guest' => 'admin.guest',
    ],
    'post' => [
        'view' => 'admin::article'
    ],
    'article' => [
        'model' => 'Pingpong\Admin\Entities\Article',
        'perpage' => 10
    ],
    'user' => [
        'model' => 'Pingpong\Admin\Entities\User',
        'perpage' => 10
    ],
    'role' => [
        'model' => 'Pingpong\Admin\Entities\Role',
        'perpage' => 10
    ],
    'permission' => [
        'model' => 'Pingpong\Admin\Entities\Permission',
        'perpage' => 10
    ],
];
