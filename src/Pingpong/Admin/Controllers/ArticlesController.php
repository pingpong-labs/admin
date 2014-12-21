<?php namespace Pingpong\Admin\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Pingpong\Admin\Repositories\ArticleRepository;
use Pingpong\Admin\Repositories\PagesRepository;
use Pingpong\Admin\Uploader\ImageUploader;

class ArticlesController extends BaseController {

    protected $articles;

    /**
     * @var ImageUploader
     */
    protected $uploader;

    /**
     * @param ImageUploader $uploader
     */
    public function __construct(ImageUploader $uploader)
    {
        $this->uploader = $uploader;

        if (Request::is('admin/pages'))
        {
            $this->articles = App::make(PagesRepository::className());
        }
        else
        {
            $this->articles = App::make(ArticleRepository::className());
        }
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return $this->redirect(isOnPages() ? 'pages.index' : 'articles.index')
            ->withFlashMessage('Post not found!')
            ->withFlashType('danger');
    }

    /**
     * Display a listing of articles
     *
     * @return Response
     */
    public function index()
    {
        $articles = $this->articles->searchOrAllPaginated(Input::get('q'));

        $no = $articles->getFrom();

        return $this->view('articles.index', compact('articles', 'no'));
    }

    /**
     * Show the form for creating a new article
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('articles.create');
    }

    /**
     * Store a newly created article in storage.
     *
     * @return Response
     */
    public function store()
    {
        app('Pingpong\Admin\Validation\Article\Create')->validate($data = $this->inputAll());

        unset($data['image']);

        if (\Input::hasFile('image'))
        {
            // upload image
            $this->uploader->upload('image')->save('images/articles');

            $data['image'] = $this->uploader->getFilename();
        }

        $data['user_id'] = \Auth::id();
        $data['slug'] = \Str::slug($data['title']);

        $this->articles->getArticle()->create($data);

        return $this->redirect(isOnPages() ? 'pages.index' : 'articles.index');
    }

    /**
     * Display the specified article.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try
        {
            $article = $this->articles->findOrFail($id);

            return $this->view('articles.show', compact('article'));
        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirectNotFound();
        }
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        try
        {
            $article = $this->articles->findOrFail($id);

            return $this->view('articles.edit', compact('article'));
        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified article in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        try
        {
            $article = $this->articles->findOrFail($id);

            app('Pingpong\Admin\Validation\Article\Update')->validate($data = $this->inputAll());

            unset($data['image']);
            unset($data['type']);

            if (\Input::hasFile('image'))
            {
                $article->deleteImage();

                $this->uploader->upload('image')->save('images/articles');

                $data['image'] = $this->uploader->getFilename();
            }

            $data['user_id'] = \Auth::id();
            $data['slug'] = \Str::slug($data['title']);
            $article->update($data);

            return $this->redirect(isOnPages() ? 'pages.index' : 'articles.index');
        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try
        {
            $this->articles->getArticle()->destroy($id);

            return $this->redirect(isOnPages() ? 'pages.index' : 'articles.index');
        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirectNotFound();
        }
    }

}
