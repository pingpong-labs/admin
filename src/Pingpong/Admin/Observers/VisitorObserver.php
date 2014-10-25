<?php namespace Pingpong\Admin\Observers;

class VisitorObserver {

    /**
     * Handle the specified event.
     *
     * @return void
     */
    public function handle()
    {
        $isOnAdmin = Request::is('admin') || Request::is('admin/*');

        if ( ! $isOnAdmin) Visitor::track();
    }

} 