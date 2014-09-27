<?php namespace Pingpong\Admin\Composers;

use Illuminate\View\View;

abstract class Composer {

    /**
     * Compose view data.
     *
     * @param View $view
     * @return mixed
     */
    abstract public function compose(View $view);

} 