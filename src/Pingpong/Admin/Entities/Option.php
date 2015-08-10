<?php

namespace Pingpong\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['key', 'value'];

    /**
     * @param $query
     * @param $key
     *
     * @return mixed
     */
    public function scopeFindByKey($query, $key)
    {
        return $query->whereKey($key);
    }
}
