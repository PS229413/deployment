<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Staff;

class Schedule extends Model
{
    protected $fillable = 
    [
        'date', 
        'start_time', 
        'end_time', 
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
