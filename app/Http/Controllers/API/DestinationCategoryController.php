<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\DestinationResource;
use App\Models\CategoryDestination;
use App\Repositories\DestinationRepository;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class DestinationCategoryController extends ApiController
{
    use ResponseAPI;
    private $destinationRepository;
    /**
     * Class constructor.
     */
    public function __construct(DestinationRepository $destinationRepository)
    {
        $this->destinationRepository = $destinationRepository;
    }
    public function getDestinationsByCategoryId(Request $request, $id)
    {
        $category = CategoryDestination::find($id);

        if (!$category) {
            return $this->requestNotFound('Category destination, not found!');
        }

        $destinations = DestinationResource::collection($this->destinationRepository->getDestinationByCategoryId($this->guard()->id(), $id));
        return $this->requestSuccessData($destinations);
    }
}
