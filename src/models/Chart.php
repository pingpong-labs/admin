<?php

class Chart extends Eloquent {

	protected $guarded = array();

	public static $rules = array();	

	public static function submenu()
	{
		$menus = array();
		$charts = static::all();
		foreach ($charts as $chart) {
			$menus[] = array(
				'title'	=>	$chart->title,
				'url'	=>	'admin/charts/'.$chart->slug
			);	
		}
		return $menus;
	}
}
