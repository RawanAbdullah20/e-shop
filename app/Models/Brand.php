<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug'
    ];
    protected static function booted()
    {
        static::deleting(function ($category) {
            $category->products()->delete();
        });
    }
    function products()
    {
        return $this->hasMany(Product::class);
    }
}
