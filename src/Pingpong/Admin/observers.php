<?php

Event::listen('admin::routes', 'Pingpong\Admin\Observers\RoutesOberver');

Event::listen('admin::visitors.track', 'Pingpong\Admin\Observers\VisitorObserver');

Event::listen('admin::menus', 'Pingpong\Admin\Observers\MenusObserver');