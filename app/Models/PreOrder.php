<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
    use HasFactory;

    // Table name if it's not the plural of the model name
    protected $table = 'pre_orders';

    // Fillable fields
    protected $fillable = ['customer_id', 'items'];

    // Cast items as an array for easy access
    protected $casts = [
        'items' => 'array',
    ];
}
