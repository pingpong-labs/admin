<?php namespace Pingpong\Admin\Observers;

use Illuminate\Support\Facades\Route;

class RoutesObserver {

    /**
     * Handle the specified event.
     *
     * @return void
     */
    public function handle()
    {
        $permalink = option('post.permalink', '{slug}');

        $controller = 'Pingpong\Admin\Controllers\SiteController';

        Route::get($permalink, ['as' => 'articles.show', 'uses' => $controller . '@showArticle']);
    }

} 