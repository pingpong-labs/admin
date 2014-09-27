<?php namespace Pingpong\Admin;

use Illuminate\Html\HtmlBuilder;

class Admin {

    protected $html;

    protected $prefixUrl = 'packages/pingpong/admin/';

    public function __construct(HtmlBuilder $html)
    {
        $this->html = $html;
    }

    public function style($url, array $attributes = [], $secure = false)
    {
        return $this->html->style($this->prefixUrl . $url, $attributes, $secure);
    }

    public function script($url, array $attributes = [], $secure = false)
    {
        return $this->html->script($this->prefixUrl . $url, $attributes, $secure);
    }
}