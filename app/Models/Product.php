<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_title',
        'product_description',
        'product_price',
        'product_qty',
        'product_category',
    ];

    public function productImages()
    {
        return $this->hasMany(ProductImages::class);
    }

    public function productOrders()
    {
        return $this->hasMany(CustomerOrders::class, 'product_id', 'id');
    }
}
