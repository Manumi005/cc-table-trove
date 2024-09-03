<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'offer_description',
        'offer_start_date',
        'offer_end_date',
    ];

    // Define a relationship with Restaurant model
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
