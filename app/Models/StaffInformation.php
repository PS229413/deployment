<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Staff;

class StaffInformation extends Model
{
    protected $fillable = [
        'name',
        'street_address',
        'postcode',
        'city',
        'identification_bsn',
        'identification_id_card',
        'identification_passport',
        'phone_number_mobile',
        'email',
        'staff_id',
    ];

    /**
     * Define an inverse one-to-one relationship with Staff model.
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
