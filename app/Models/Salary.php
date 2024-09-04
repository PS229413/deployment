<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'amount',
        'salary_date',
    ];

    protected $dates = [
        'salary_date',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
