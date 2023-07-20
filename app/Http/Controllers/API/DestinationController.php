<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\DestinationIdRequest;
use App\Http\Resources\CategoryDestinationResource;
use App\Http\Resources\DestinationResource;
use App\Repositories\CategoryDestinationRepository;
use App\Repositories\DestinationRepository;
use Illuminate\Http\Request;

class DestinationController extends ApiController
{

    private $destinationRepository, $categoryDestinationRepository;



    /**
     * 
     * Class constructor.
     */
    public function __construct(DestinationRepository $destinationRepository, CategoryDestinationRepository $categoryDestinationRepository)
    {
        $this->destinationRepository = $destinationRepository;
        $this->categoryDestinationRepository = $categoryDestinationRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('ok');
        $destinations = DestinationResource::collection($this->destinationRepository->getAllDestinationsWithSave($this->guard()->id()));
        return $this->requestSuccessData($destinations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    /**
     * Save destination
     */
    public function toogleDestination(DestinationIdRequest $destinationIdRequest)
    {
        try {
            $input = $destinationIdRequest->only('destination_id');
            $condition = $this->destinationRepository->assignSaveOrUnsaveDestination($input['destination_id'],  $this->guard()->id());
            return $this->requestSuccessData([
                "assignSaveDestination" => $condition,
                "destination_id" => $input['destination_id']
            ]);
        } catch (\Throwable $th) {
            throw $th;
            return $this->badRequest();
        }
    }
    /**
     * Get Categories destination
     */
    public function getDestinationCategories()
    {
        $categoriesDestination = CategoryDestinationResource::collection($this->categoryDestinationRepository->getDestinationCategories());
        return $this->requestSuccessData($categoriesDestination);
    }
    public function getRecordSaveDestination()
    {
        $destinations = DestinationResource::collection($this->destinationRepository->getHistorySaveDestination($this->guard()->id()));
        return $this->requestSuccessData($destinations);
    }
}
