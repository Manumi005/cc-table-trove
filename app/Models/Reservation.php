<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'restaurant_id',
        'reservation_date',
        'time_slot',
        'party_size',
    ];

    /**
     * Get the customer that owns the reservation.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the restaurant that owns the reservation.
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
