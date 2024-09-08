<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customization extends Model
{
    protected $fillable = [
        'reservation_id',
        'customizations',
        'special_occasion',
        'table_location',
        'additional_requests',
    ];

    protected $casts = [
        'customizations' => 'array',
        'special_occasion' => 'array',
    ];

    /**
     * Relationship: a customization belongs to a reservation.
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
