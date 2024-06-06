<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(

            [
                'name' => 'Laptops',
                'slug' => 'laptops'
            ],


        );
        Category::create(

            [
                'name' => 'Desktops',
                'slug' => 'desktops'
            ],
        );
        Category::create(

            [
                'name' => 'Mini PC',
                'slug' => 'mini-pc'
            ],
        );
        Category::create(

            [
                'name' => 'Tablet',
                'slug' => 'tablet'
            ],
        );
    }
}