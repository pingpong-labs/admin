<?php

namespace Pingpong\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected $entities = [
        'Article',
        'Category'
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->entities as $entity) {
            $this->{"bind" . $entity . "Repository"}();
        }
    }

    protected function bindArticleRepository()
    {
        $this->app->bind(
            'Pingpong\Admin\Repositories\Articles\ArticleRepository',
            'Pingpong\Admin\Repositories\Articles\EloquentArticleRepository'
        );
    }

    protected function bindCategoryRepository()
    {
        $this->app->bind(
            'Pingpong\Admin\Repositories\Categories\CategoryRepository',
            'Pingpong\Admin\Repositories\Categories\EloquentCategoryRepository'
        );
    }

}
