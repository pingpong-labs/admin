<?php

class Visitor extends Eloquent {
    
	protected $guarded = array();

	public static $rules = array();

	/* track visitor */
    public static function track()
    {
        $ip = Request::server('REMOTE_ADDR');
        $date = date("Y-m-d");
        $visitor = Visitor::whereRaw("LEFT(created_at,10) = '$date'")
        	->whereIp($ip)
        	->first()
        ;
        if (!empty($visitor)) {
            $update = date("Y-m-d H:i:s");
            $online = time();
            $visitor->update([
            	'updated_at'	=> $update
            ]);
        } else {
            Visitor::create([
            	'ip' => $ip,
                'time' => time()
            ]);
        }
    }
}
