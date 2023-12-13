<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::truncate();
        foreach ($this->categoriesDefault as $category)
        {
            Category::create($category);
        }
    }

    //grafik, photo, presentation, themes dan script.
    private array $categoriesDefault = [
        [
            'name' =>  'graphic',
            'description' => 'Icons, backgrounds, patterns and vectors',
            'type' => 'product',
            'children' => [
                [
                    'name' =>  'Print templates',
                    'type' => 'product',
                ],
                [
                    'name' =>  'Product mockup',
                    'type' => 'product',
                ],
                [
                    'name' =>  'Website',
                    'type' => 'product',
                ],
                [
                    'name' =>  'Ux and UI kits',
                    'type' => 'product',
                ],
                [
                    'name' =>  'Social Media Template',
                    'type' => 'product',
                ],
            ],
        ],
        [
            'name' =>  'photo',
            'description' => 'Discover our premium stock images',
            'type' => 'product',

        ],
        [
            'name' =>  'presentation',
            'type' => 'product',
            'description' => 'No matter the type of presentation you are working on, we have the right creative assets for you. Discover thousands of presentation themes for PowerPoint, Keynote and Google Slides themes.Find PowerPoint templates and Google Slides templates for any use, and application. Including,  templates compatible with PowerPoint , templates for use on Instagram or templates optimized for A4. Popular selections include, Mockup Powerpoint Templates, Presentation Templates tagged as being aesthetic , or food-related Powerpoint Templates Plus, take your presentations to the next level with Grafiko Tuts. For a round-up of the best templates, visit our blog!',

            'children' => [
                [
                    'name' =>  'Keynotes',
                    'type' => 'product',
                ],
                [
                    'name' =>  'Power point',
                    'type' => 'product',
                ],
                [
                    'name' =>  'Google Slide',
                    'type' => 'product',
                ],
            ],
        ],
        [
            'name' =>  'themes',
            'type' => 'product',
        ],
        [
            'name' =>  'script',
            'type' => 'product',
            'children' => [
                [
                    'name' =>  'PHP Script',
                    'type' => 'product',
                ],
                [
                    'name' =>  'HTML',
                    'type' => 'product',
                ],
            ],
        ],
    ];
}
