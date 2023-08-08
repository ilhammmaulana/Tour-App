<?php

namespace App\Repositories;

use App\Models\City;
use App\Models\Province;

interface PlacesRepositoryInterface
{
    public function getProvinces(): object;
    public function getCities(): object;
}


class PlacesRepository implements PlacesRepositoryInterface
{
    public function getProvinces(): object
    {
        return Province::orderBy('name', 'DESC')->get();
    }
    public function getCities(): object
    {
        return City::orderBy('name', 'DESC')->get();
    }
}
