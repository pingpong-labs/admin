<?php

namespace Pingpong\Admin\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Pingpong\Admin\Uploader\ImageUploader;
use Pingpong\Admin\Validation\Article\Create;
use Pingpong\Admin\Validation\Article\Update;

class ArticlesController extends BaseController
{
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

        $this->repository = $this->getRepository();
    }

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository()
    {
        if (isOnPages()) {
            $repository = 'Pingpong\Admin\Repositories\Pages\PageRepository';
        } else {
            $repository = 'Pingpong\Admin\Repositories\Articles\ArticleRepository';
        }

        return app($repository);
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
     * Display a listing of articles.
     *
     * @return Response
     */
    public function index()
    {
        $articles = $this->repository->allOrSearch(Input::get('q'));

        $no = $articles->firstItem();

        return $this->view('articles.index', compact('articles', 'no'));
    }

    /**
     * Show the form for creating a new article.
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
    public function store(Create $request)
    {
        $data = $request->all();

        unset($data['image']);

        if (\Input::hasFile('image')) {
            // upload image
            $this->uploader->upload('image')->save('images/articles');

            $data['image'] = $this->uploader->getFilename();
        }

        $data['user_id'] = \Auth::id();
        $data['slug'] = Str::slug($data['title']);

        $this->repository->create($data);

        return $this->redirect(isOnPages() ? 'pages.index' : 'articles.index');
    }

    /**
     * Display the specified article.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $article = $this->repository->findById($id);

            return $this->view('articles.show', compact('article'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $article = $this->repository->findById($id);

            return $this->view('articles.edit', compact('article'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified article in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(Update $request, $id)
    {
        try {
            $article = $this->repository->findById($id);

            $data = $request->all();

            unset($data['image']);
            unset($data['type']);

            if (\Input::hasFile('image')) {
                $article->deleteImage();

                $this->uploader->upload('image')->save('images/articles');

                $data['image'] = $this->uploader->getFilename();
            }

            $data['user_id'] = \Auth::id();
            $data['slug'] = Str::slug($data['title']);
            $article->update($data);

            return $this->redirect(isOnPages() ? 'pages.index' : 'articles.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified article from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return $this->redirect(isOnPages() ? 'pages.index' : 'articles.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
