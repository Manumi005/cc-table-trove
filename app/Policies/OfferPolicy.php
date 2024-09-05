<?php

namespace App\Policies;

use App\Models\Offer;
use App\Models\Restaurant;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the restaurant can view the offer.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\Offer  $offer
     * @return bool
     */
    public function view(Restaurant $restaurant, Offer $offer)
    {
        return $restaurant->id === $offer->restaurant_id;
    }

    /**
     * Determine whether the restaurant can update the offer.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\Offer  $offer
     * @return bool
     */
    public function update(Restaurant $restaurant, Offer $offer)
    {
        return $restaurant->id === $offer->restaurant_id;
    }

    /**
     * Determine whether the restaurant can delete the offer.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \App\Models\Offer  $offer
     * @return bool
     */
    public function delete(Restaurant $restaurant, Offer $offer)
    {
        return $restaurant->id === $offer->restaurant_id;
    }
}
