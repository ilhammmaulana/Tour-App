<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryDestinationRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $categoryDestinationRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryDestinationRepository $categoryDestinationRepository)
    {
        $this->categoryDestinationRepository = $categoryDestinationRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categoryDestinations = $this->categoryDestinationRepository->getDestinationCategories();
        return view('pages.dashboard', [
            "categoryDestinations" => $categoryDestinations
        ]);
    }
}
