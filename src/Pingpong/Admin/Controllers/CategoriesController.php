<?php namespace Pingpong\Admin\Controllers;

use Pingpong\Admin\Entities\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoriesController extends BaseController {
	
	/**
	 * @var \Category
	 */
	protected $categories;

	/**
	 * @param \Category $categories
	 */
	public function __construct(Category $categories)
	{
		$this->categories = $categories;
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
	 * Display a listing of categories
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = $this->categories->paginate(10);
		$no 		  = $categories->getFrom();

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
		$data 		= $this->inputAll();
		$rules      = $this->categories->getRules();
		$validator 	= $this->validator->make($data, $rules);

		if ($validator->fails())
		{
			return $this->redirect->back()->withErrors($validator)->withInput();
		}

		$this->categories->create($data);

		return $this->redirect('categories.index');
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
			$category = $this->categories->findOrFail($id);
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
			$category = $this->categories->findOrFail($id);
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
			$data 		=	$this->inputAll();
			$category = 	$this->categories->findOrFail($id);
			$rules		=   $this->categories->getUpdateRules();

			$validator  = $this->validator->make($data, $rules);

			if ($validator->fails())
			{
				return $this->redirect->back()->withErrors($validator)->withInput();
			}

			$category->update($data);

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
			$this->categories->destroy($id);

			return $this->redirect('categories.index');
		}		
		catch(ModelNotFoundException $e)
		{
			return $this->redirectNotFound();
		}
	}

}
