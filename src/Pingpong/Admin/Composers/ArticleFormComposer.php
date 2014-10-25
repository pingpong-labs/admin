<?php namespace Pingpong\Admin\Composers;

use Pingpong\Admin\Entities\Category;

class ArticleFormComposer {

    public function compose($view)
    {
        $categories = Category::lists('name', 'id');

        $view->with(compact('categories'));
    }

}