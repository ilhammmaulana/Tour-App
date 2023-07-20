<?php

namespace App\Repositories;

use App\Models\CategoryDestination;

interface CategoryDestinationRepositoryInterface
{
    public function getDestinationCategories();
}

class CategoryDestinationRepository implements CategoryDestinationRepositoryInterface
{
    public function getDestinationCategories()
    {
        try {
            $categories = CategoryDestination::all();
            return $categories;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
