<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name'];


    public function staffs()
    {
        return $this->belongsToMany(Staff::class, 'staff_roles', 'role_id', 'staff_id');
    }
}
