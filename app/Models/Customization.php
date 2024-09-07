<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customization extends Model
{
    protected $fillable = ['customizations', 'special_occasion', 'table_location', 'additional_requests'];

    protected $casts = [
        'customizations' => 'array',
        'special_occasion' => 'array',
    ];
}
