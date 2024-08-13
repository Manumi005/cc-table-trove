<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id', 
        'name', 
        'description', 
        'price', 
        'category', 
        'image', 
        'allergens',
        'dietary'
    ];

    protected $casts = [
        'allergens' => 'array',
        'category' => 'array',
        'dietary' => 'array',
    ];

    /**
     * Relationship with Restaurant model
     * A Menu belongs to a Restaurant
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
