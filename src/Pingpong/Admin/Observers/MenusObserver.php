<?php namespace Pingpong\Admin\Observers;

class MenusObserver {

    /**
     * Handle the specified event.
     *
     * @return void
     */
    public function handle()
    {
        require __DIR__ . '/../menus.php';
    }

} 