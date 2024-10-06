<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = ['restaurant_id', 'user_name', 'rating', 'review', 'flag_status'];

    // Remove relationships involving customer_id
}
