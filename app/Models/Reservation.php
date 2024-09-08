<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'restaurant_id',
        'reservation_date',
        'time_slot',
        'party_size',
        'status',
        'customizations',
        'special_occasions',
        'table_location',
    ];

    // Cast reservation_date to a date object
    protected $dates = ['reservation_date'];

    /**
     * Get the customer that owns the reservation.
     */

    protected $casts = [
        'customizations' => 'array',
        'special_occasions' => 'array',
    ];
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
    public function customizations()
    {
        return $this->hasMany(Customization::class);
    }
}
