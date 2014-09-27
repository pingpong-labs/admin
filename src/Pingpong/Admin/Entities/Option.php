<?php namespace Pingpong\Admin\Entities;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;

class Option extends Model {

    /**
     * The fillable attributes.
     *
     * @var array
     */
    protected $fillable = ['key', 'value'];

    /**
     * Scope find option by the given key.
     *
     * @param Builder $query
     * @param $key
     * @return mixed
     */
    public function scopeFindByKey(Builder $query, $key)
    {
        return $query->whereKey($key);
    }
}