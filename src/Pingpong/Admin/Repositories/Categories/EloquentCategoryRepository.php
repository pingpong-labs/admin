<?php

namespace Pingpong\Admin\Repositories\Categories;

use Pingpong\Admin\Entities\Category;

class EloquentCategoryRepository implements CategoryRepository
{
    public function perPage()
    {
        return config('admin.category.perpage');
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
        return Category::latest()->paginate($this->perPage());
    }

    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";
        
        return Category::where('name', 'like', $search)
            ->orWhere('slug', 'like', $search)
            ->paginate($this->perPage())
        ;
    }

    public function findById($id)
    {
        return Category::find($id);
    }

    public function findBy($key, $value, $operator = '=')
    {
        return Category::where($key, $operator, $value)->paginate($this->perPage());
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
        return Category::create($data);
    }
}
