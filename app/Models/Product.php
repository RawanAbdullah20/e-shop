<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'title',
        'slug',
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
    ];
    use HasFactory;
}