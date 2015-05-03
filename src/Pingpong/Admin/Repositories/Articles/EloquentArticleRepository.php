<?php

namespace Pingpong\Admin\Repositories\Articles;

use Pingpong\Admin\Entities\Article;

class EloquentArticleRepository implements ArticleRepository
{
    public function perPage()
    {
        return config('admin.article.perpage');
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
        return Article::latest()->paginate($this->perPage());
    }

    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";
        
        return Article::where('title', 'like', $search)
            ->orWhere('body', 'like', $search)
            ->orWhere('id', '=', $searchQuery)
            ->paginate($this->perPage())
        ;
    }

    public function findById($id)
    {
        return Article::find($id);
    }

    public function findBy($key, $value, $operator = '=')
    {
        return Article::where($key, $operator, $value)->paginate($this->perPage());
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
        return Article::create($data);
    }
}
