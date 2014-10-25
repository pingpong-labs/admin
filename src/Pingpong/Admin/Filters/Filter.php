<?php namespace Pingpong\Admin\Filters;

use Pingpong\Admin\Traits\ClassNameTrait;

abstract class Filter {

    use ClassNameTrait;

    /**
     * Filter the specified request.
     *
     * @return mixed
     */
    abstract public function filter();

}