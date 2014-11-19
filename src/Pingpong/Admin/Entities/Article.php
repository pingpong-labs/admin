<?php namespace Pingpong\Admin\Entities;

use Pingpong\Presenters\Model;

class Article extends Model {

    /**
     * @var string
     */
    protected $presenter = 'Pingpong\Admin\Presenters\Article';

    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'user_id',
        'category_id',
        'title',
        'slug',
        'body',
        'image',
        'published_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(__NAMESPACE__ . '\\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(__NAMESPACE__ . '\\Category');
    }

    /**
     * Coming soon.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany('Comment', 'commentable');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNewest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeOnlyPage($query)
    {
        return $query->whereType('page');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeOnlyPost($query)
    {
        return $query->whereType('post');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->whereNull('published_at');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeDrafted($query)
    {
        return $query->whereNotNull('published_at');
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeBySlugOrId($query, $id)
    {
        return $query->whereId($id)->orWhere('slug', '=', $id);
    }

    /**
     * Boot the eloquent.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($data)
        {
            $data->deleteImage();
        });
    }

    /**
     * @return bool
     */
    public function deleteImage()
    {
        $file = $this->present()->image_path;

        if (file_exists($file))
        {
            @unlink($file);

            return true;
        }

        return false;
    }
}