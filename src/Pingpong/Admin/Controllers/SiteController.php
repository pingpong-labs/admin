<?php namespace Pingpong\Admin\Controllers;

session_start();

use Pingpong\Admin\Entities\Option;
use Pingpong\Admin\Entities\Article;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SiteController extends BaseController
{	
	public function index()
	{
		return $this->view('index');
	}

	public function logout()
	{
		$this->auth->logout();
		
		unset($_SESSION['admin']);

		return $this->redirect('login.index');
	}

	public function settings()
	{
		return $this->view('settings');
	}

	public function reset()
	{
		$tables = array(
			'products', 'articles', 'categories', 'events', 'lessons', 'classes', 'comments', 'notifications',
			'projects', 'designs', 'votes', 'sliders', 'photos', 'orders',
		);

		foreach ($tables as $table)
		{
			$this->db->table($table)->truncate();
		}

		return $this->redirect('settings')->withFlashMessage('Database has been reset successfully!');
	}

	public function reinstall()
	{
		$this->artisan->call('migrate:refresh');
		
		$this->artisan->call('db:seed');

		return $this->redirect('settings')->withFlashMessage('Reinstalled success!');
	}
	
	public function clearCache()
	{
		$this->artisan->call('cache:clear');

		return $this->redirect('settings')->withFlashMessage('Application cache cleared!');
	}

	public function updateSettings()
	{
		$settings = $this->input->all();
		foreach ($settings as $key => $value)
		{
			$option = str_replace('_', '.', $key);
			Option::findByKey($option)->update([
				'value'	=>	$value
			]);
		}
		return $this->redirect->back()->withFlashMessage('Settings has been successfully updated!');
	}

	public function showArticle($id)
	{
		try
		{
			$post = Article::with('user')->whereId($id)->orWhere('slug', $id)->firstOrFail();

			$view = $this->config->get('admin::post.view');

			return $this->view->make($view, compact('post')); 
		}

		catch(ModelNotFoundException $e)
		{
			return \App::abort(404);
		}
	}
}