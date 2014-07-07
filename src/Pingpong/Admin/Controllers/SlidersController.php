<?php namespace Pingpong\Admin\Controllers;

use Slider;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Pingpong\Uploader\ImageUploader;

class SlidersController extends BaseController {
	
	/**
	 * @var \Slider
	 */
	protected $sliders;

	protected $uploader;

	/**
	 * @param \Slider $sliders
	 */
	public function __construct(Slider $sliders, ImageUploader $uploader)
	{
		$this->sliders = $sliders;
		$this->uploader = $uploader;
	}
	
	/**
	 * Redirect not found.
	 *
	 * @return Response
	 */
	protected function redirectNotFound()
	{
		return $this->redirect('sliders.index');
	}

	/**
	 * Display a listing of sliders
	 *
	 * @return Response
	 */
	public function index()
	{
		$sliders = $this->sliders->paginate(10);
		$no 		  = $sliders->getFrom();

		return $this->view('sliders.index', compact('sliders', 'no'));
	}

	/**
	 * Show the form for creating a new slider
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->view('sliders.create');
	}

	/**
	 * Store a newly created slider in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data 		= $this->inputAll();
		$rules      = $this->sliders->getRules();
		$validator 	= $this->validator->make($data, $rules);

		if ($validator->fails())
		{
			return $this->redirect->back()->withErrors($validator)->withInput();
		}

		// upload image
		$this->uploader->upload('image')->save('images/sliders');
		
		unset($data['image']);

		$data['user_id'] = \Auth::id();
		$data['slug']  = \Str::slug($data['title']);
		$data['image'] = $this->uploader->getFilename();

		$this->sliders->create($data);

		return $this->redirect('sliders.index');
	}

	/**
	 * Display the specified slider.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		try
		{
			$slider = $this->sliders->findOrFail($id);
			return $this->view('sliders.show', compact('slider'));
		}
		catch(ModelNotFoundException $e)
		{
			return $this->redirectNotFound();
		}
	}

	/**
	 * Show the form for editing the specified slider.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{		
		try
		{
			$slider = $this->sliders->findOrFail($id);
			return $this->view('sliders.edit', compact('slider'));
		}		
		catch(ModelNotFoundException $e)
		{
			return $this->redirectNotFound();
		}
	}

	/**
	 * Update the specified slider in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try
		{
			$data 		=	$this->inputAll();
			$slider = 	$this->sliders->findOrFail($id);
			$rules		=   $this->sliders->getUpdateRules();

			$validator  = $this->validator->make($data, $rules);

			if ($validator->fails())
			{
				return $this->redirect->back()->withErrors($validator)->withInput();
			}
			
			unset($data['image']);

			if($this->input->hasFile('image'))
			{
				$slider->deleteImage();

				$this->uploader->upload('image')->save('images/sliders');
				
				$data['image'] = $this->uploader->getFilename();
			}

			$data['user_id'] = \Auth::id();
			$data['slug']  = \Str::slug($data['title']);

			$slider->update($data);

			return $this->redirect('sliders.index');
		}
		catch(ModelNotFoundException $e)
		{
			return $this->redirectNotFound();
		}
	}

	/**
	 * Remove the specified slider from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		try
		{
			$this->sliders->destroy($id);

			return $this->redirect('sliders.index');
		}		
		catch(ModelNotFoundException $e)
		{
			return $this->redirectNotFound();
		}
	}

}
