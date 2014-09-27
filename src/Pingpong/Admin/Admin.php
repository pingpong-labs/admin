<?php namespace Pingpong\Admin;

use Illuminate\Html\HtmlBuilder;

class Admin {

    /**
     * @var HtmlBuilder
     */
    protected $html;

    /**
     * @var string
     */
    protected $prefixUrl = 'packages/pingpong/admin/';

    /**
     * @param HtmlBuilder $html
     */
    public function __construct(HtmlBuilder $html)
    {
        $this->html = $html;
    }

    /**
     * @param $url
     * @param array $attributes
     * @param bool $secure
     * @return string
     */
    public function style($url, array $attributes = [], $secure = false)
    {
        return $this->html->style($this->prefixUrl . $url, $attributes, $secure);
    }

    /**
     * @param $url
     * @param array $attributes
     * @param bool $secure
     * @return string
     */
    public function script($url, array $attributes = [], $secure = false)
    {
        return $this->html->script($this->prefixUrl . $url, $attributes, $secure);
    }
}