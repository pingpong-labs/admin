<?php namespace Pingpong\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Pingpong\Admin\Entities\Option;

class OptionsTableSeeder extends Seeder {

	public function run()
	{
		Option::truncate();
		
		$options = array(
			array(
				'key'	=>	'site.name',
				'value'	=>	'My Site Name'
			),
			array(
				'key'	=>	'site.slogan',
				'value'	=>	'The Great Website!'
			),
			array(
				'key'	=>	'site.description',
				'value'	=>	'My Site.'
			),
			array(
				'key'	=>	'site.keywords',
				'value'	=>	'pingpong, gravitano, panenmaya'
			),
			array(
				'key'	=>	'tracking',
				'value'	=>	'<!-- GA Here -->'
			),
			array(
				'key'	=>	'facebook.link',
				'value'	=>	'https://www.facebook.com/'
			),
			array(
				'key'	=>	'twitter.link',
				'value'	=>	'https://twitter.com/'
			),
			array(
				'key'	=>	'post.permalink',
				'value'	=>	'{slug}'
			),
		);

		foreach($options as $option)
		{
			Option::create($option);
		}
	}

}