<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Restaurant extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'restaurant_name', 'email', 'contact_number', 'address', 'cuisine_type', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
