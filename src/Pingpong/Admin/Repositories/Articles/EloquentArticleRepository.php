<?php

namespace Pingpong\Admin\Repositories\Articles;

use Pingpong\Admin\Entities\Article;

class EloquentArticleRepository implements ArticleRepository
{
    public function perPage()
    {
        return config('admin.article.perpage');
    }

    public function getModel()
    {
        $model = config('admin.article.model');

        return new $model();
    }

    public function getArticle()
    {
        return $this->getModel()->onlyPost();
    }

    public function allOrSearch($searchQuery = null)
    {
        if (is_null($searchQuery)) {
            return $this->getAll();
        }

        return $this->search($searchQuery);
    }

    public function getAll()
    {
        return $this->getArticle()->latest()->paginate($this->perPage());
    }

    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";

        return $this->getArticle()->where('title', 'like', $search)
            ->orWhere('body', 'like', $search)
            ->orWhere('id', '=', $searchQuery)
            ->paginate($this->perPage())
        ;
    }

    public function findById($id)
    {
        return $this->getArticle()->find($id);
    }

    public function findBy($key, $value, $operator = '=')
    {
        return $this->getArticle()->where($key, $operator, $value)->paginate($this->perPage());
    }

    public function delete($id)
    {
        $article = $this->findById($id);

        if (!is_null($article)) {
            $article->delete();

            return true;
        }

        return false;
    }

    public function create(array $data)
    {
        return $this->getModel()->create($data);
    }
}
