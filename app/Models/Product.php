<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar',
        'nama',
        'harga',
        'stok',
        'kadar_air',
        'tekstur',
        'aroma',
        'satuan',
        ];
}
