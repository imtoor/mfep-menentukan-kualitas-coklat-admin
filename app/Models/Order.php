<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function order_item() {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
