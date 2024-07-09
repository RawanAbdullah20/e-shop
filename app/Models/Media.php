<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'original_filename',
        'mime_type',
        'path',
        'url',
        'size',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_media');
    }
}
