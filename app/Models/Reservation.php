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
        'payment_status',
        'status',
        'customizations',
        'special_occasions',
        'table_location',
        'additional_requests', // Add this field if not already present
    ];

    // Cast reservation_date to a date object
    protected $dates = ['reservation_date'];

    protected $casts = [
        'customizations' => 'array',
        'special_occasions' => 'array',
        'additional_requests' => 'array', // Cast additional_requests as an array if applicable
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

    /**
     * Get the customizations associated with the reservation.
     */
    public function customizations()
    {
        return $this->hasMany(Customization::class);
    }
}
