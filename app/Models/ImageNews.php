<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageNews extends Model
{
    protected $fillable = ['news_id', 'image_id'];
    protected $table = 'images_news';
    public $timestamps = false;
    use HasFactory;
}
