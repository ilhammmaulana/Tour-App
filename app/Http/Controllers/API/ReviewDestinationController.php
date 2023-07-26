<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CreateDestinationReview;
use App\Repositories\ReviewDestinationRepository;
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
        try {
            $data = $this->reviewDestinationRepository->createReview($input, $this->guard()->id());
            return $this->requestSuccessData($data, 201);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
