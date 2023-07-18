<?php

namespace App\Repositories;

use App\Models\Destination;


interface DestinationRepositoryInterface
{
    public function getAllDestinations();
}

class DestinationRepository
{
    public function getAllDestinations()
    {
        try {
            $destinations = Destination::all();
            return $destinations;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
