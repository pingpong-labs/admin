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
        'perpage' => 10
    ],
    'user' => [
        'model' => 'Pingpong\Admin\Entities\User',
        'perpage' => 10
    ],
];
