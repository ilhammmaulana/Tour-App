<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlacesResource;
use App\Repositories\PlacesRepository;
use Illuminate\Http\Request;

class PlacesController extends ApiController
{
    private $placesRepository;
    /**
     * Class constructor.
     */
    public function __construct(PlacesRepository $placesRepository)
    {
        $this->placesRepository = $placesRepository;
    }
    public function getProvinces()
    {
        $provinces = PlacesResource::collection($this->placesRepository->getProvinces());
        return $this->requestSuccessData($provinces);
    }
    public function getCities()
    {
        $provinces = PlacesResource::collection($this->placesRepository->getCities());
        return $this->requestSuccessData($provinces);
    }
}
