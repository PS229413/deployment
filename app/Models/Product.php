<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['kuin_id', 'name', 'description', 'sku', 'stock', 'supplier_price',
        'price_margin', 'discount', 'image', 'color', 'height', 'width', 'depth', 'weight', 'active'];
    public $timestamps = false;
    use HasFactory;
}
