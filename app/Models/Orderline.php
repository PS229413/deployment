<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderline extends Model
{
    protected $table = 'order_lines';
    protected $fillable = ['order_id', 'product_id', 'amount', 'status'];
    public $timestamps = false;
    use HasFactory;
}
