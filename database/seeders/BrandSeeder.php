<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create(
            [
                'name' => 'Acer',
                'slug' => 'acer'
            ],
        );
        Brand::create(

            [
                'name' => 'Apple',
                'slug' => 'apple'
            ],
        );
        Brand::create(

            [
                'name' => 'Asus',
                'slug' => 'asus'
            ],
        );
        Brand::create(

            [
                'name' => 'Dell',
                'slug' => 'dell'
            ],
        );
        Brand::create(

            [
                'name' => 'HP',
                'slug' => 'hp'
            ],
        );
        Brand::create(

            [
                'name' => 'LG Electronics',
                'slug' => Str::of('LG Electronics')->slug('-')
            ],
        );
        Brand::create(

            [
                'name' => 'Lenovo',
                'slug' => 'msi'
            ],
        );
    }
}