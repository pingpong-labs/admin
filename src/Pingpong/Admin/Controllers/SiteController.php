<?php namespace Pingpong\Admin\Controllers;

session_check();

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Pingpong\Admin\Entities\Article;
use Pingpong\Admin\Entities\Option;

class SiteController extends BaseController {

    /**
     * Admin dashboard.
     *
     * @return \Response
     */
    public function index()
    {
        return $this->view('index');
    }

    /**
     * Logout.
     *
     * @return \Response
     */
    public function logout()
    {
        \Auth::logout();

        unset($_SESSION['admin']);

        return $this->redirect('login.index');
    }

    /**
     * Settings Page.
     *
     * @return \Response
     */
    public function settings()
    {
        if ( ! defined('STDIN'))
        {
            define('STDIN', fopen("php://stdin", "r"));
        }

        return $this->view('settings');
    }

    /**
     * Reinstall the application.
     *
     * @return mixed
     */
    public function reinstall()
    {
        \Artisan::call('migrate:refresh');

        \Artisan::call('db:seed');

        return $this->redirect('settings')->withFlashMessage('Reinstalled success!');
    }

    /**
     * Clear the application cache.
     *
     * @return mixed
     */
    public function clearCache()
    {
        \Artisan::call('cache:clear');

        return $this->redirect('settings')->withFlashMessage('Application cache cleared!');
    }

    /**
     * Update the settings.
     *
     * @return mixed
     */
    public function updateSettings()
    {
        $settings = \Input::all();

        foreach ($settings as $key => $value)
        {
            $option = str_replace('_', '.', $key);

            Option::findByKey($option)->update([
                'value' => $value
            ]);
        }

        return \Redirect::back()->withFlashMessage('Settings has been successfully updated!');
    }

    /**
     * Show article.
     *
     * @param  int $id
     * @return mixed
     */
    public function showArticle($id)
    {
        try
        {
            $post = Article::with('user', 'category')
                           ->whereId(intval($id))
                           ->orWhere('slug', $id)
                           ->firstOrFail();

            $view = \Config::get('admin::post.view');

            return \View::make($view, compact('post'));
        }

        catch (ModelNotFoundException $e)
        {
            return \App::abort(404);
        }
    }
}