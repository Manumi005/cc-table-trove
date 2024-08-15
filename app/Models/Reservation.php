<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;


class Reservation extends Model{

    use HasFactory;

    protected $fillable = ['user_id', 'restaurant_id', 'reservation_date', 'time_slot', 'party_size', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}