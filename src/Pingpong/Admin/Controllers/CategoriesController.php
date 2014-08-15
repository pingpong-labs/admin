<?php namespace Pingpong\Admin\Controllers;

use Pingpong\Admin\Entities\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoriesController extends BaseController {
	
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
	 * Display a listing of categories
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = Category::paginate(10);
		$no 		= $categories->getFrom();

		return $this->view('categories.index', compact('categories', 'no'));
	}

	/**
	 * Show the form for creating a new category
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
	public function store()
	{
		$category = Category::create($this->inputAll());
        if($category->save())
        {
            return $this->redirect('categories.index');
        }
        return $this->redirect->back()->withInput()->withErrors($category->getErrors());
	}

	/**
	 * Display the specified category.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		try
		{
			$category = Category::findOrFail($id);

			return $this->view('categories.show', compact('category'));
		}
		catch(ModelNotFoundException $e)
		{
			return $this->redirectNotFound();
		}
	}

	/**
	 * Show the form for editing the specified category.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{		
		try
		{
			$category = Category::findOrFail($id);

			return $this->view('categories.edit', compact('category'));
		}		
		catch(ModelNotFoundException $e)
		{
			return $this->redirectNotFound();
		}
	}

	/**
	 * Update the specified category in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try
		{
			$category = Category::findOrFail($id);
			
			$category->update($this->inputAll());

			if( ! $category->save())
			{
				return $this->redirect->back()->withErrors($category->getErrors())->withInput();
			}

			return $this->redirect('categories.index');
		}
		catch(ModelNotFoundException $e)
		{
			return $this->redirectNotFound();
		}
	}

	/**
	 * Remove the specified category from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		try
		{
			Category::destroy($id);

			return $this->redirect('categories.index');
		}		
		catch(ModelNotFoundException $e)
		{
			return $this->redirectNotFound();
		}
	}

}
