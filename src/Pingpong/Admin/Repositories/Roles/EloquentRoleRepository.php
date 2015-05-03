<?php

namespace Pingpong\Admin\Repositories\Roles;

use Pingpong\Admin\Entities\Role;

class EloquentRoleRepository implements RoleRepository
{
    public function perPage()
    {
        return config('admin.role.perpage');
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
        return Role::latest()->paginate($this->perPage());
    }

    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";
        
        return Role::where('name', 'like', $search)
            ->orWhere('slug', 'like', $search)
            ->paginate($this->perPage())
        ;
    }

    public function findById($id)
    {
        return Role::find($id);
    }

    public function findBy($key, $value, $operator = '=')
    {
        return Role::where($key, $operator, $value)->paginate($this->perPage());
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
        return Role::create($data);
    }
}
