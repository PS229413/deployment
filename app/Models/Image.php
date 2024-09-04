<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'newsimages';
    protected $fillable = ['image'];
    public $timestamps = false;
    use HasFactory;
}
