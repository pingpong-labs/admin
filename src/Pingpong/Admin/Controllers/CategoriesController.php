<?php

namespace Pingpong\Admin\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Pingpong\Admin\Entities\Category;
use Pingpong\Admin\Repositories\Categories\CategoryRepository;
use Pingpong\Admin\Validation\Category\Create;
use Pingpong\Admin\Validation\Category\Update;

class CategoriesController extends BaseController
{
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return $this->redirect('categories.index');
    }

    /**
     * Display a listing of categories.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $categories = $this->repository->allOrSearch($request->get('q'));

        $no = $categories->firstItem();

        return $this->view('categories.index', compact('categories', 'no'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @return Response
     */
    public function store(Create $request)
    {
        $data = $request->all();

        $category = Category::create($data);

        return $this->redirect('categories.index');
    }

    /**
     * Display the specified category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $category = $this->repository->findById($id);

            return $this->view('categories.show', compact('category'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $category = $this->repository->findById($id);

            return $this->view('categories.edit', compact('category'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified category in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(Update $request, $id)
    {
        try {
            $data = $request->all();

            $category = $this->repository->findById($id);

            $category->update($data);

            return $this->redirect('categories.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified category from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return $this->redirect('categories.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
