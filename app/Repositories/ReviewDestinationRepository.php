<?php

namespace App\Repositories;

use App\Models\ReviewDestination;

interface ReviewDestinationInterface
{
    public function createReview($data, $created_by);
}

class ReviewDestinationRepository implements ReviewDestinationInterface
{
    public function createReview($data, $created_by)
    {
        try {
            $data['created_by'] = $created_by;
            return ReviewDestination::create($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
