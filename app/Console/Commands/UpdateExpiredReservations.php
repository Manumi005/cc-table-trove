<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;

class UpdateExpiredReservations extends Command
{
    protected $signature = 'reservations:update-expired';
    protected $description = 'Update the status of expired reservations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $reservations = Reservation::where('reservation_date', '<', now()->toDateString())
            ->where('status', '<>', 'Expired')
            ->get();

        foreach ($reservations as $reservation) {
            $reservation->status = 'Expired';
            $reservation->save();
        }

        $this->info('Expired reservations updated successfully.');
    }
}
