<?php namespace Pingpong\Admin\Entities;

class Option extends \Eloquent {

    /**
     * @var array
     */
    protected $fillable = ['key', 'value'];

    /**
     * @param $query
     * @param $key
     * @return mixed
     */
    public function scopeFindByKey($query, $key)
    {
        return $query->whereKey($key);
    }
}