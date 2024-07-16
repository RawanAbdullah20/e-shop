<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Product extends Model
{

    protected $fillable = [
        'media_ids',
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
        'slug',
    ];
    use HasFactory;
    use HasSlug;

    protected $casts = [
        'media_ids' => 'array',
    ];
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    function media()
    {
        return $this->belongsToMany(Media::class, 'product_media', 'product_id', 'media_id');
    }
    function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function booted()
    {
        static::saved(function ($product) {
            if ($product->isDirty('media_ids')) {
                $product->media()->sync($product->media_ids);
            }
        });
        static::deleting(function ($product) {
            $mediaToDelete = $product->media()->get();
            $product->media()->detach();
            foreach ($mediaToDelete as $media) {
                if (Storage::exists($media->path)) {
                    Storage::delete($media->path);
                }
                $media->delete();
            }
        });
    }
}
