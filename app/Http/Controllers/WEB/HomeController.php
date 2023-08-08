<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryDestinationRepository;
use App\Repositories\DestinationRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $categoryDestinationRepository, $destinationRepository, $userRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryDestinationRepository $categoryDestinationRepository, DestinationRepository $destinationRepository, UserRepository $userRepository)
    {
        $this->categoryDestinationRepository = $categoryDestinationRepository;
        $this->destinationRepository = $destinationRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categoryDestinations = $this->categoryDestinationRepository->getDestinationCategories();
        $countDestination = $this->destinationRepository->countDestination();
        $countUser = $this->userRepository->countUsers();
        return view('pages.dashboard', [
            "categoryDestinations" => $categoryDestinations,
            "count_destination" => $countDestination,
            "count_user" => $countUser

        ]);
    }
}
