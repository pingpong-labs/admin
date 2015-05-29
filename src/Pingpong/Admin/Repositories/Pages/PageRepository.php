<?php

namespace Pingpong\Admin\Repositories\Pages;

use Pingpong\Admin\Repositories\Repository;

interface PageRepository extends Repository
{
    public function getPage();
}
