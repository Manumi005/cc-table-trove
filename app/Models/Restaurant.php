<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Restaurant extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'contact_number',
        'address',
        'cuisine_type',
        'password',
        'opening_hours',
        'details',
        'images', // Use 'images' if that’s the column name
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'images' => 'array',        // Cast 'images' as an array if using 'images'
        'cuisine_type' => 'array',
    ];
}
