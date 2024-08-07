<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasSlug;

    use HasFactory;
    protected $fillable = [
        'name',
        'slug'
    ];
    function products()
    {
        return $this->hasMany(Product::class);
    }
    protected static function booted()
    {
        static::deleting(function ($category) {
            $category->products()->delete();
        });
    }
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }
}
