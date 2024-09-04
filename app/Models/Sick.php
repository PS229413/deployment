<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Staff;

class Sick extends Model
{
    protected $fillable = 
    [
        'start_date', 
        'end_date', 
        'staff_id'
    ];

    /**
     * Define an inverse one-to-many relationship with Staff model.
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
