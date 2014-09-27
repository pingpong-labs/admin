<?php

return [
	'filter'	=>	[
		'auth'	=>	'admin.auth',
		'guest'	=>	'admin.guest',
	],
	'post'	=>	[
		'view'	=>	'admin::article'
	],
    'menu'  =>  [
        'presenter' =>  'Pingpong\\Admin\\Menus\\Presenters\\Bootstrap\\NavbarPresenter'
    ]
];