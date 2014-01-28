<?php

namespace Pingpong\Admin;

use Request, Config, DB, View, Resource, Input, Validator;
use Redirect;
use Admin;
use Pingpong\Admin\AdminException as Exception;

class ResourceController extends \Controller
{
	protected $resource;

	protected $resourceName;

	protected $request;

	protected $allResources;

	function __construct()
	{
		$this->allResources = Config::get("admin::admin.resources");
		$this->request = Request::segment(2);
		$this->validate($this->request); 
	}

	protected function validate($request)
	{
		if( ! in_array($request, $this->allResources))
		{
			return App::abort(404);
		}else
		{
			$this->register($request);
		}
	}

	protected function register($resource)
	{
		$config = Config::get("resources::$resource");
		if( ! empty($config) )
		{
			$this->resource = $config;
			$this->resourceName = $resource;
		}else
		{
			throw new Exception("Resource [$resource] have not config file.");
		}
	}

	public function index()
	{
		$eloquent = $this->resource['eloquent'];
		$paginate = $this->resource['data-perpage'];

		$table 	= $this->resource['table'];
		$fields = $this->resource['fields']['show'];
		$fields	= Resource::getFields($table, $fields);

		$headingArray = $this->resource['fields']['format'];
		$heading = Resource::heading($fields, $headingArray);

		$count = $eloquent::count();
		$data = $eloquent::paginate($paginate);

		$datas = array(
			'datas'		=>	$data,
			'count'		=>	$count,
			'fields'	=>	$fields,
			'resource'	=>	$this->resource,
			'heading'	=>	$heading,
			'format'	=>	$headingArray
		);

		return View::make('admin::resources.index', $datas);

	}

	public function create()
	{ 
		$resource = $this->resource;
		return View::make('admin::resources.create', compact('resource'));
	}

	public function store()
	{
		$resource = $this->resource;
		$eloquent = $this->resource['eloquent'];

		$rules 		= $resource['validation']['create']['rules'];
		$messages 	= $resource['validation']['create']['messages'];
		$format 	= Admin::getConfig($this->resourceName, 'validation.update.format');
		if(empty($format) or !is_array($format))
		{
			$format = array();
		}
		
		$input 		= Input::all();

		$validation = Validator::make($input, $rules, $messages);
		if($validation->passes())
		{	
			if(count($format) > 0)
			{
				foreach ($format as $field => $callback) {
					if(isset($input[$field])){
						$value = $input[$field];
						$newValue = call_user_func_array($callback, [$value]);
						$input = array_except($input, $field);
						$input = array_add($input, $field, $newValue);
					}
				}
			}
			$eloquent::create($input);			
			return Redirect::to('admin/'.Request::segment(2))
				->with('message-success', 'Data created successfully.')
			;
		}
		return Redirect::to('admin/'.Request::segment(2).'/create')
			->withInput()
			->withErrors($validation)
		;
	}

	public function show($id)
	{
		$resource = $this->resource;
		$eloquent = $this->resource['eloquent'];
		$data = $eloquent::findOrFail($id);

		return View::make('admin::resources.show', compact('data', 'resource'));
	}

	public function edit($id)
	{		
		$resource = $this->resource;
		$eloquent = $this->resource['eloquent'];
		$data = $eloquent::findOrFail($id);

		return View::make('admin::resources.edit', compact('data', 'resource'));
	}


	public function update($id)
	{
		$resource = $this->resource;
		$eloquent = $this->resource['eloquent'];

		$rules 		= $resource['validation']['update']['rules'];
		$messages 	= $resource['validation']['update']['messages'];
		$format 	= Admin::getConfig($this->resourceName, 'validation.update.format');
		if(empty($format) or !is_array($format))
		{
			$format = array();
		}

		$input 		= Input::all();
		$input 		= array_except($input, '_method');

		$validation = Validator::make($input, $rules, $messages);
		if($validation->passes())
		{	
			$find = $eloquent::find($id);
			if(!empty($find))
			{	
				if(count($format) > 0)
				{
					foreach ($format as $field => $callback) {
						if(isset($input[$field])){
							$value = $input[$field];
							$newValue = call_user_func_array($callback, [$value]);
							$input = array_except($input, $field);
							$input = array_add($input, $field, $newValue);
						}
					}
				}
				$find->update($input);
				return Redirect::to('admin/'.Request::segment(2))
					->with('message-success', 'Data updated successfully.')
				;
			}	
			return Redirect::to('admin/'.Request::segment(2))
				->with('message-success', 'Failed to update. Data not found.')
			;		
		}
		return Redirect::to('admin/'.Request::segment(2)."/$id/edit")
			->withInput()
			->withErrors($validation)
		;
	}

	public function destroy($id)
	{
		$resource = $this->resource;
		$eloquent = $this->resource['eloquent'];
		$data = $eloquent::find($id);

		if(!empty($data))
		{
			$data->delete();			
			return Redirect::to('admin/'.Request::segment(2))
				->with('message-success', 'Data has been deleted successfully.')
			;
		}			
		return Redirect::to('admin/'.Request::segment(2))
			->with('message-error', 'Failed to delete. Data not found.')
		;
	}

	public function postSearch()
	{
		if(Input::has('search'))
		{
			return Redirect::to('admin/'.Request::segment(2).'/search/'. Input::get('search'));
		}
		return Redirect::to('admin/'.Request::segment(2))
			->with('message-error', 'Failed to search. Text is empty.')
		;
	}

	public function getSearch($q)
	{
		$eloquent = $this->resource['eloquent'];
		$paginate = $this->resource['data-perpage'];

		$table 	= $this->resource['table'];
		$fields = $this->resource['fields']['show'];
		$fields	= Resource::getFields($table, $fields);

		$headingArray = $this->resource['fields']['format'];
		$heading = Resource::heading($fields, $headingArray);

		if(! isset($this->resource['search']) )
		{
			throw new Exception("Resource [$this->request] does not have search criteria. Please put one or more criteria on your array config.");
		}
		$search = $this->resource['search'];
		$find = $eloquent::where(function($query) use ($search, $q)
		{
			if(is_array($search))
			{
				if(count($search) > 1)
				{
					$query->where($search[0], 'LIKE', "%$q%");
					foreach ($search as $key => $find) {
						if($key == 0) continue;
						$query->orWhere($find, 'LIKE', "%$q%");
					}
				}else{
					$query->where($search[0], 'LIKE', "%$q%");
				}
			}elseif(is_string($search)){
				$query->where($search, 'LIKE', "%$q%");
			}
		});

		$count = $find->count();
		$data = $find->paginate($paginate);

		$datas = array(
			'datas'		=>	$data,
			'count'		=>	$count,
			'fields'	=>	$fields,
			'resource'	=>	$this->resource,
			'heading'	=>	$heading,
			'format'	=>	$headingArray,
			'q'			=>	$q
		);

		return View::make('admin::resources.search', $datas);
	}
}