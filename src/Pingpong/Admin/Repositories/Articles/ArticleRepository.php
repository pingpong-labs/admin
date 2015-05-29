<?php

namespace Pingpong\Admin\Repositories\Articles;

use Pingpong\Admin\Repositories\Repository;

interface ArticleRepository extends Repository
{
    public function getArticle();
}
