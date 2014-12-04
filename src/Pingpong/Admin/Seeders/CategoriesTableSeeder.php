<?php namespace Pingpong\Admin\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Pingpong\Admin\Entities\Category;

class CategoriesTableSeeder extends Seeder {

    public function run()
    {
        Category::truncate();

        $categories = [
        	'General'
        ];

        foreach ($categories as $category)
        {
        	Category::create([
        		'name' => $category,
        		'slug' => Str::slug($category)
        	]);
        }
    }

}