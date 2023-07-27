<?php

namespace App\Repositories;

use App\Models\ReviewDestination;

interface ReviewDestinationInterface
{
    public function createReview($data, $created_by);
    public function getReviewByDestinationAndCreatedBy($destinationId, $createdBy);
    public function getHistoryReviewUser($user_id);
    public function findReviewById($id);
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
    /**
     * Get a review by destination_id and created_by.
     *
     * @param string $destinationId
     * @param string $createdBy
     * @return \App\Models\ReviewDestination|null
     */
    public function getReviewByDestinationAndCreatedBy($destinationId, $createdBy)
    {
        return ReviewDestination::where('destination_id', $destinationId)
            ->where('created_by', $createdBy)
            ->first();
    }

    public function getReviewsByDestination($destinationId)
    {
        return ReviewDestination::with('user')
            ->where('destination_id', $destinationId)
            ->get();
    }

    public function getHistoryReviewUser($user_id)
    {
        return ReviewDestination::with('destination')
            ->where('created_by', $user_id)
            ->get();
    }
    /**
     * Find a review by its ID.
     *
     * @param string $id
     * @return \App\Models\ReviewDestination|null
     */
    public function findReviewById($id)
    {
        return ReviewDestination::find($id);
    }
}
