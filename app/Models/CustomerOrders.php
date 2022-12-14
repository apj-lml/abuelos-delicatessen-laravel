<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrders extends Model
{
    use HasFactory;

    protected $table = 'customer_orders';

    protected $fillable = [
        'full_name',
        'customer_id',
        'product_id',
        'shipping_address',
        'order_qty',
        'amount',
        'order_date',
        'order_status',
        'invoice_no',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
