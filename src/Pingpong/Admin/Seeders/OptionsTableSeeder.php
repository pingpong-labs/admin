<?php namespace Pingpong\Admin\Seeders;

use Illuminate\Database\Seeder;
use Pingpong\Admin\Entities\Option;

class OptionsTableSeeder extends Seeder {

    public function run()
    {
        Option::truncate();

        $options = array(
            array(
                'key' => 'site.name',
                'value' => 'My Site Name'
            ),
            array(
                'key' => 'site.slogan',
                'value' => 'The Great Website!'
            ),
            array(
                'key' => 'site.description',
                'value' => 'My Site.'
            ),
            array(
                'key' => 'site.keywords',
                'value' => 'pingpong, gravitano'
            ),
            array(
                'key' => 'tracking',
                'value' => '<!-- GA Here -->'
            ),
            array(
                'key' => 'facebook.link',
                'value' => 'https://www.facebook.com/pingponglabs'
            ),
            array(
                'key' => 'twitter.link',
                'value' => 'https://twitter.com/pingponglabs'
            ),
            array(
                'key' => 'post.permalink',
                'value' => '{slug}'
            ),
            array(
                'key' => 'ckfinder.prefix',
                'value' => 'packages/pingpong/admin'
            ),
            array(
                'key' => 'admin.theme',
                'value' => 'default'
            ),
            array(
                'key' => 'pagination.perpage',
                'value' => 10
            ),
        );

        foreach ($options as $option)
        {
            Option::create($option);
        }
    }

}