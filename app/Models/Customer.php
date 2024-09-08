<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'contact_number',
        'password',
        'allergies',
        'preferences',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'allergies' => 'array',
        'preferences' => 'array',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
