<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $fillable = ['category_id', 'product_id'];
    protected $table = 'category_product';
    public $timestamps = false;
    use HasFactory;
}
