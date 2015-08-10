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
        'User',
        'Article',
        'Page',
        'Category',
        'Role',
        'Permission',
    ];

    /**
     * Register the service provider.
     */
    public function register()
    {
        foreach ($this->entities as $entity) {
            $this->{'bind'.$entity.'Repository'}();
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

    protected function bindUserRepository()
    {
        $this->app->bind(
            'Pingpong\Admin\Repositories\Users\UserRepository',
            'Pingpong\Admin\Repositories\Users\EloquentUserRepository'
        );
    }

    protected function bindRoleRepository()
    {
        $this->app->bind(
            'Pingpong\Admin\Repositories\Roles\RoleRepository',
            'Pingpong\Admin\Repositories\Roles\EloquentRoleRepository'
        );
    }

    protected function bindPermissionRepository()
    {
        $this->app->bind(
            'Pingpong\Admin\Repositories\Permissions\PermissionRepository',
            'Pingpong\Admin\Repositories\Permissions\EloquentPermissionRepository'
        );
    }

    protected function bindPageRepository()
    {
        $this->app->bind(
            'Pingpong\Admin\Repositories\Pages\PageRepository',
            'Pingpong\Admin\Repositories\Pages\EloquentPageRepository'
        );
    }
}
