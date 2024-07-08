<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'media',
    ];

    // public function products()
    // {
    //     return $this->belongsToMany(Product::class, 'product_media', 'media_id', 'product_id')
    //         ->withTimestamps();
    // }
}