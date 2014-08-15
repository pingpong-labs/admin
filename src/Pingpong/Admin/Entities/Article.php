<?php namespace Pingpong\Admin\Entities;

use Pingpong\Presenters\Model;

class Article extends Model
{
    protected $presenter = 'Pingpong\Admin\Presenters\Article';

	protected $fillable = ['type', 'user_id', 'category_id', 'title', 'slug', 'body', 'image', 'published_at'];

	protected $rules = array(
		'title'	=>	'required',
		'body'	=>	'required',
		'image'	=>	'required|image',
	);

	public function user()
	{
		return $this->belongsTo(__NAMESPACE__ . '\\User');
	}

	public function category()
	{
		return $this->belongsTo(__NAMESPACE__ . '\\Category');
	}

	// coming soon
	public function comments()
	{
		return $this->morphMany('Comment', 'commentable');
	}

	// validation
	public function getRules()
	{
		return $this->rules;
	}

	public function getUpdateRules()
	{
		return array_except($this->rules, 'image');
	}

	// scopes
	public function scopeNewest($query)
	{
		return $query->orderBy('created_at', 'desc');
	}

	public function scopeOnlyPage($query)
	{
		return $query->whereType('page');
	}

	public function scopeOnlyPost($query)
	{
		return $query->whereType('post');
	}

	public function scopePublished($query)
	{
		return $query->whereNull('published_at');
	}

	public function scopeDrafted($query)
	{
		return $query->whereNotNull('published_at');
	}

	public function scopeBySlugOrId($query, $id)
	{
		return $query->whereId($id)->orWhere('slug', '=', $id);
	}

	// events
	public static function boot()
	{
		parent::boot();

		static::deleting(function($data)
		{
			$data->deleteImage();
		});
	}

	public function deleteImage()
	{
		$file = $this->present()->image_path;
		if(file_exists($file))
		{
			@unlink($file);
			return true;
		}
		return false;
	}
}