<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    /** @use HasFactory<\Database\Factories\ProductImagesFactory> */
    use HasFactory;

    protected $fillable = [
        'image_path',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
