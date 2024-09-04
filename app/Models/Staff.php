<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\Staff as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\StaffInformation;
use App\Models\Schedule;
use App\Models\Sick;

class Staff extends Authenticatable implements JWTSubject
{
  use HasApiTokens, Notifiable;
    protected $fillable =
    [
        'name',
        'birth',
        'email',
        'password',
        'api_token',
    ];

    /**
     * Define a one-to-one relationship with StaffInformation model.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'staff_roles', 'staff_id', 'role_id');
    }
    public function staffInformation()
    {
        return $this->hasOne(StaffInformation::class);
    }

    /**
     * Define a one-to-many relationship with Schedule model.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Define a one-to-many relationship with Sick model.
     */
    public function sickDays()
    {
        return $this->hasMany(Sick::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }
}
