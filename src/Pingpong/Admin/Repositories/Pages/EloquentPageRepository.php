<?php

namespace Pingpong\Admin\Repositories\Pages;

use Pingpong\Admin\Repositories\Articles\EloquentArticleRepository;
use Pingpong\Admin\Repositories\Repository;

class EloquentPageRepository extends EloquentArticleRepository implements Repository
{
    public function perPage()
    {
        return config('admin.page.perpage');
    }

    public function getModel()
    {
        $model = config('admin.article.model');

        return new $model();
    }

    public function getPage()
    {
        return $this->getModel()->onlyPage();
    }

    public function create(array $data)
    {
        if (!isset($data['type'])) {
            $data['type'] = 'page';
        }

        return $this->getModel()->create($data);
    }

    public function getAll()
    {
        return $this->getPage()->latest()->paginate($this->perPage());
    }

    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";

        return $this->getPage()->where('title', 'like', $search)
            ->orWhere('body', 'like', $search)
            ->orWhere('id', '=', $searchQuery)
            ->paginate($this->perPage())
        ;
    }

    public function findById($id)
    {
        return $this->getPage()->find($id);
    }

    public function findBy($key, $value, $operator = '=')
    {
        return $this->getPage()->where($key, $operator, $value)->paginate($this->perPage());
    }
}
