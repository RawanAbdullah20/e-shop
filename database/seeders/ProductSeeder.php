<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/data/products.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            Product::create(array(
                'id' => $obj->id,
                'title' => $obj->title,
                'slug' => Str::of($obj->slug)->slug('-'),
                'quantity' => $obj->quantity,
                'description' => $obj->description,
                'price' => $obj->price,
                'brand_id' => $obj->brand_id,
                'category_id' => $obj->category_id,
            ));
        }
    }
}