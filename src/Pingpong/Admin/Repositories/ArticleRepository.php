<?php namespace Pingpong\Admin\Repositories;

use Pingpong\Admin\Entities\Article;
use Pingpong\Admin\Traits\ClassNameTrait;

class ArticleRepository implements RepositoryInterface {

    use ClassNameTrait;

    /**
     * @var Article
     */
    protected $article;

    /**
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
        $this->init();
    }

    /**
     * Init
     */
    public function init()
    {
        if(isOnPages())
            $this->article = $this->article->onlyPage();
        else
            $this->article = $this->article->onlyPost();
    }

    /**
     * Get all resources.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->article->all();
    }

    /**
     * Get all resources or search resources by given $search.
     *
     * @param string|null $search
     * @return mixed
     */
    public function allOrSearch($search = null)
    {
        if ( ! is_null($search)) return $this->search($search);

        return $this->all();
    }

    /**
     * @param null $search
     * @param int $perPage
     * @return mixed
     */
    public function searchOrAllPaginated($search = null, $perPage = 10)
    {
        if ( ! is_null($search)) return $this->search($search);

        return $this->allPaginated($perPage);
    }

    /**
     * Get the specified resource by given $id.
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->article->findOrFail($id);
    }

    /**
     * Alias for "find" method.
     * 
     * @param  int $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return $this->find($id);
    }

    /**
     * Search resources by given $search.
     *
     * @param string $search
     * @param int $perPage
     * @return mixed
     */
    public function search($search, $perPage = 10)
    {
        return $this->article->where(function ($query) use ($search)
        {
            $q = "%{$search}%";

            return $query->where('title', 'like', $q)->where('body', 'like', $q);
        })->paginate($perPage);
    }

    /**
     * Get all resources and paginate the result by given $perPage.
     *
     * @param int $perPage
     * @return mixed
     */
    public function allPaginated($perPage = 10)
    {
        return $this->article->paginate($perPage);
    }

    /**
     * @return Article
     */
    public function getArticle()
    {
        return new Article;
    }

    /**
     * @param Article $article
     * @return $this
     */
    public function setArticle(Article $article)
    {
        $this->article = $article;

        return $this;
    }

}