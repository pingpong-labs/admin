<?php

namespace Pingpong\Admin\Composers;

class LayoutComposer
{
    public function compose($view)
    {
        $layout = config('admin.views.layout', 'admin::layouts.master');

        $view->with(compact('layout'));
    }
}
