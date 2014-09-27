<?php namespace Pingpong\Admin\Seeders;

use Pingpong\Admin\Entities\Option;

class OptionsTableSeeder extends \Seeder {

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
			array(
				'key'	=>	'ckfinder.prefix',
				'value'	=>	'packages/pingpong/admin'
			),
			array(
				'key'	=>	'admin.theme',
				'value'	=>	'default'
			),
		);

		foreach($options as $option)
		{
			Option::create($option);
		}
	}

}