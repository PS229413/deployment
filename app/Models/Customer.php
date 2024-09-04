<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasApiTokens;
    public $timestamps = false;
    protected $fillable = ['username', 'email', 'password', 'firstname',
        'lastname', 'phone', 'birthday', 'address', 'city', 'postcode', 'country'];
    use HasFactory;
}
