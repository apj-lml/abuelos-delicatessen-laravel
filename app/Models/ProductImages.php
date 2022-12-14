<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;
    
    protected $table = 'product_images';
    
    protected $fillable = [
        'image_path',
        'file_name',
        'image_type',
        'product_id',
        'is_thumbnail',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
