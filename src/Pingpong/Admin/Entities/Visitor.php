<?php namespace Pingpong\Admin\Entities;

use Request, DB, URL;

class Visitor extends \Eloquent
{
	/**
	 * Fillable Property.
	 * 
	 * @var array
	 */
	protected $fillable = ['ip', 'hits', 'online', 'url', 'path'];

	/**
	 * Track hits online visitors.
	 * 
	 * @return void 
	 */
	public static function track()
	{		
		$ip 	= Request::server('REMOTE_ADDR');
		$online = time();
		$url	= URL::full();
		$path   = Request::path();

		$visited = static::whereIp($ip)->today()->first();
		if( ! empty($visited))
		{
			$visited->update([
				'online'	=>	$online,
				'hits'		=>  $visited->hits + 1,	
				'url'		=>	$url,
				'path'		=>	$path			
			]);	
		}
		else
		{
			static::createNewVisitor();
		}
	}

	/**
	 * Create new visitor.
	 * 
	 * @return self 
	 */
	public static function createNewVisitor()
	{
		return static::create([
			'online'	=>	time(),
			'ip'		=>	Request::server('REMOTE_ADDR'),
			'hits'		=>	1,
			'url'		=>	URL::full(),
			'path'		=>	Request::path()
		]);
	}

	// scopes
	public function scopeToday($query)
	{
		return $query->whereRaw("LEFT(created_at, 10) = LEFT(NOW(), 10)");
	}

	public function scopeSelectTotalHits($query)
	{
		return $query->select('visitors.*', DB::raw("SUM(hits) as total_hits"));
	}

	// helpers
	public static function getHitsToday()
	{
		$data = static::today()->selectTotalHits()->first();

		return isset($data->total_hits) ? $data->total_hits : 0;
	}

	public static function getTotalVisitorsToday()
	{
		return static::today()->count();
	}

	public static function getTotalHits()
	{
		$data = static::selectTotalHits()->first();
		
		return isset($data->total_hits) ? $data->total_hits : 0;
	}

	public static function getOnlineUsers()
	{
		$time = time() - 300;
		
		$data = static::where('online', '>', $time)
			->groupBy('ip')
			->select('ip', DB::raw("COUNT(*) as total_users"))
			->first();
		
		return isset($data->total_users) ? $data->total_users : 0;
	}
}