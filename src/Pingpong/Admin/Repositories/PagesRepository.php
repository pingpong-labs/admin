<?php namespace Pingpong\Admin\Repositories;

class PagesRepository extends ArticleRepository {

    /**
     * Init
     */
    public function init()
    {
        $this->article = $this->article->onlyPage();
    }

}