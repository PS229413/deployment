<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public $table = 'news';
    protected $fillable = ['title', 'content', 'writer', 'created_at', 'updated_at'];
    use HasFactory;
}
