<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CreateDestinationReview;
use App\Http\Requests\API\UpdateReviewDestinationRequest;
use App\Http\Resources\ReviewDestinationHistoryResource;
use App\Http\Resources\ReviewDestinationResource;
use App\Repositories\ReviewDestinationRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ReviewDestinationController extends ApiController
{
    private $reviewDestinationRepository;
    /**
     * Class constructor.
     */
    public function __construct(ReviewDestinationRepository $reviewDestinationRepository)
    {
        $this->reviewDestinationRepository = $reviewDestinationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ReviewDestinationHistoryResource::collection($this->reviewDestinationRepository->getHistoryReviewUser($this->guard()->id()));
        return $this->requestSuccessData($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDestinationReview $createDestinationReview)
    {
        $input = $createDestinationReview->only('description', 'star', 'destination_id');
        $createdBy = $this->guard()->id();

        $existingReview = $this->reviewDestinationRepository->getReviewByDestinationAndCreatedBy($input['destination_id'], $createdBy);

        if ($existingReview) {
            return $this->badRequest('already_exist', 'You already reviewed this destination!');
        }
        try {
            $data = $this->reviewDestinationRepository->createReview($input, $this->guard()->id());
            return $this->requestSuccessData($data, 201);
        } catch (QueryException $e) {
            // Handle the integrity constraint violation error here
            if ($e->getCode() === '23000') {
                return $this->badRequest('already_exist', 'You already reviewed this destination!');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewDestinationRequest $updateReviewDestinationRequest, $id)
    {
        $review = $this->reviewDestinationRepository->findReviewById($id);

        if (!$review) {
            return $this->requestNotFound('Review not found!');
        }

        if ($review->created_by !== $this->guard()->id()) {
            return $this->requestUnauthorized('You are not authorized to update this review.');
        }

        $review->update($updateReviewDestinationRequest->only('description', 'star'));

        return $this->requestSuccessData(new ReviewDestinationResource($review), 200, 'Review updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
