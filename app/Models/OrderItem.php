<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Order;
use App\Models\Product;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_item';

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function products() {
        return $this->belongsTo(Product::class, 'products_id');
    }
}
