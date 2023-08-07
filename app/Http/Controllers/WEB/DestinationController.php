<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CreateDestinationReview;
use App\Http\Requests\WEB\CreateDestinationRequest;
use App\Repositories\CategoryDestinationRepository;
use App\Repositories\DestinationRepository;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    private $destinationRepository, $categoryDestinationRepository;
    /**
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
        $destinataions = $this->destinationRepository->getAllDestination(true);
        $categories = $this->categoryDestinationRepository->getDestinationCategories();
        return view('pages.destinations', [
            "destinations" =>  $destinataions,
            "category_destinations" => $categories,
            "page" => "destinations"
        ]);
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
    public function store(CreateDestinationRequest $createDestinationRequest)
    {
        $input = $createDestinationRequest->only('name', 'address', 'price', 'category_id', 'longitude', 'latitude', 'description');
        dd($input);
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
