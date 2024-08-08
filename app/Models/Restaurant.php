<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    // The attributes that are mass assignable.
    protected $fillable = [
        'name',
        'email',
        'contact_number',
        'address',
        'cuisine_type', // Stores comma-separated values
        'password',
    ];

    // The attributes that should be hidden for arrays.
    protected $hidden = [
        'password',
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'cuisine_type' => 'array', // Automatically cast `cuisine_type` to an array when retrieving
    ];

    // Accessor to get `cuisine_type` as an array
    public function getCuisineTypeAttribute($value)
    {
        // Ensure we handle cases where `cuisine_type` might be null
        return $value ? explode(',', $value) : [];
    }

    // Mutator to set `cuisine_type` as a comma-separated string
    public function setCuisineTypeAttribute($value)
    {
        $this->attributes['cuisine_type'] = is_array($value) ? implode(',', $value) : $value;
    }
}
