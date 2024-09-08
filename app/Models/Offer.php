<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    // Specify the table if it's different from the plural of the model name
    protected $table = 'offers';

    // Define the fillable properties
    protected $fillable = [
        'title',
        'description',
        'discount',
        'valid_from',
        'valid_until',
        'image',
        'restaurant_id',
    ];

    // Cast attributes to their native types
    protected $casts = [
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
