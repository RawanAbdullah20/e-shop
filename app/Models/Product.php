<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'title',
        'description',
        'price',
        'published',
        'inStock',
        'quantity',
        'created_by',
        'updated_by',
        'deleted_by',
        'brand_id',
        'category_id',
        'slug'
    ];
    use HasFactory;

    function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }
    function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    function category()
    {
        return $this->belongsTo(Category::class);
    }
}
