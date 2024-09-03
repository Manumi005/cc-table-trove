<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
        Restaurant::create([
            'name' => 'Sample Restaurant',
            'category' => 'Italian',
            'price' => 25,
            'offer_type' => 'discount',
            'image_url' => 'path/to/image.jpg',
        ]);

        // Add more restaurant records as needed
    }
}
