<?php namespace Pingpong\Admin\Entities;

use DB;
use Request;
use URL;
use Pingpong\Presenters\Model;

class Visitor extends Model {

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
        $ip = Request::server('REMOTE_ADDR');
        $online = time();
        $url = URL::full();
        $path = Request::path();

        $visited = static::whereIp($ip)->today()->first();
        if ( ! empty($visited))
        {
            $visited->update([
                'online' => $online,
                'hits' => $visited->hits + 1,
                'url' => $url,
                'path' => $path
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
            'online' => time(),
            'ip' => Request::server('REMOTE_ADDR'),
            'hits' => 1,
            'url' => URL::full(),
            'path' => Request::path()
        ]);
    }

    // scopes
    /**
     * @param $query
     * @return mixed
     */
    public function scopeToday($query)
    {
        // mysql 
        $raw = "date(created_at) = date(now())";
        
        if(db_is('sqlite'))
        {
            $raw = "date(created_at) = date(date('now'))"; 
        }

        return $query->whereRaw($raw);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeSelectTotalHits($query)
    {
        return $query->select('visitors.*', DB::raw("SUM(hits) as total_hits"));
    }

    /**
     * @return int
     */
    public static function getHitsToday()
    {
        $data = static::today()->selectTotalHits()->first();

        return isset($data->total_hits) ? $data->total_hits : 0;
    }

    /**
     * @return mixed
     */
    public static function getTotalVisitorsToday()
    {
        return static::today()->count();
    }

    /**
     * @return int
     */
    public static function getTotalHits()
    {
        $data = static::selectTotalHits()->first();

        return isset($data->total_hits) ? $data->total_hits : 0;
    }

    /**
     * @return int
     */
    public static function getOnlineUsers()
    {
        $time = time() - 300;

        $data = static::where('online', '>', $time)
                      ->groupBy('ip')
                      ->select('ip', DB::raw("count(*) as total_users"))
                      ->first();

        return isset($data->total_users) ? $data->total_users : 0;
    }
}