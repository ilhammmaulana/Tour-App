<?php

namespace App\Repositories;

use App\Models\Destination;
use App\Models\SavedDestination;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

interface DestinationRepositoryInterface
{
    public function getAllDestination();
    public function getAllDestinationsWithSave($user_id);
    public function assignSaveOrUnsaveDestination($destination_id, $created_by);
    public function getHistorySaveDestination($user_id);
    public function getDestinationByCategoryId($category_id);
    public function countDestination(): int;
    public function deleteDestination($id);
    public function getDestinationByProvinceId($id, $user_id);
}
class DestinationRepository implements DestinationRepositoryInterface
{
    public function countDestination(): int
    {
        return Destination::count();
    }
    public function getAllDestination($paginate = false)
    {
        $query = Destination::selectRaw('destinations.*, AVG(review_destinations.star) as average_rating')
            ->leftJoin('review_destinations', 'destinations.id', '=', 'review_destinations.destination_id')
            ->groupBy('destinations.id', 'destinations.name', 'destinations.description', 'destinations.image', 'destinations.province_id', 'destinations.price', 'destinations.city_id', 'destinations.created_by', 'destinations.category_id', 'destinations.address', 'destinations.longitude', 'destinations.latitude', 'destinations.created_at', 'destinations.updated_at')
            ->latest();

        if ($paginate) {
            return $query->paginate(10);
        } else {
            $destinations = $query->get();
            return $destinations;
        }
    }
    public function getAllDestinationsWithSave($user_id)
    {
        try {
            $destinations = Destination::with(['reviews.user'])->select('destinations.*')
                ->selectSub(function ($query) {
                    $query->selectRaw('round(avg(star), 2)')
                        ->from('review_destinations')
                        ->whereColumn('destination_id', 'destinations.id');
                }, 'average_rating')
                ->leftJoin('saved_destinations', function ($join) use ($user_id) {
                    $join->on('destinations.id', '=', 'saved_destinations.destination_id')
                        ->where('saved_destinations.created_by', '=', $user_id);
                })
                ->addSelect(DB::raw('CASE WHEN saved_destinations.id IS NULL THEN false ELSE true END AS save_by_you'))
                ->latest()->get();
            return $destinations;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getOne($id, $user_id)
    {
        try {
            $destinations = Destination::with(['reviews.user'])->select('destinations.*')
                ->selectSub(function ($query) {
                    $query->selectRaw('round(avg(star), 2)')
                        ->from('review_destinations')
                        ->whereColumn('destination_id', 'destinations.id');
                }, 'average_rating')
                ->leftJoin('saved_destinations', function ($join) use ($user_id) {
                    $join->on('destinations.id', '=', 'saved_destinations.destination_id')
                        ->where('saved_destinations.created_by', '=', $user_id);
                })
                ->addSelect(DB::raw('CASE WHEN saved_destinations.id IS NULL THEN false ELSE true END AS save_by_you'))
                ->latest()->firstOrFail($id);
            return $destinations;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function assignSaveOrUnsaveDestination($destination_id, $created_by)
    {
        try {
            $existingRecord = SavedDestination::where('destination_id', $destination_id)
                ->where('created_by', $created_by)
                ->first();

            if ($existingRecord) {
                $existingRecord->delete();
                return false;
            } else {
                SavedDestination::create([
                    "destination_id" => $destination_id,
                    "created_by" => $created_by
                ]);
                return true;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getHistorySaveDestination($user_id)
    {
        $savedDestinations = SavedDestination::with('destination')
            ->where('created_by', $user_id)
            ->get();
        return $savedDestinations->pluck('destination');;
    }
    public function getDestinationByCategoryId($category_id)
    {
        try {
            return Destination::with(['reviews' => function ($query) {
                $query->select('destination_id', DB::raw('avg(star) as average_rating'))
                    ->groupBy('destination_id');
            }])
                ->where('category_id', $category_id)->select('id', 'name', 'description', 'image', 'province_id', 'created_by', 'category_id', 'address', 'longitude', 'latitude', 'created_at', 'updated_at')
                ->get()
                ->map(function ($destination) {
                    $destination->average_rating = $destination->reviews->first()->average_rating ?? null;
                    unset($destination->reviews);
                    return $destination;
                });
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function createDestination($data)
    {
        try {
            return Destination::create($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function deleteDestination($id)
    {
        try {
            $destination = Destination::findOrFail($id);

            if ($destination->image) {
                Storage::delete($destination->image);
            }

            $deleted = Destination::destroy($id);

            return redirect('destinations')->with('success', 'Success delete destination!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getDestinationByProvinceId($id, $user_id)
    {
        try {
            $destinations = Destination::with(['reviews.user'])->where('province_id', $id)->select('destinations.*')
                ->selectSub(function ($query) {
                    $query->selectRaw('round(avg(star), 2)')
                        ->from('review_destinations')
                        ->whereColumn('destination_id', 'destinations.id');
                }, 'average_rating')
                ->leftJoin('saved_destinations', function ($join) use ($user_id) {
                    $join->on('destinations.id', '=', 'saved_destinations.destination_id')
                        ->where('saved_destinations.created_by', '=', $user_id);
                })
                ->addSelect(DB::raw('CASE WHEN saved_destinations.id IS NULL THEN false ELSE true END AS save_by_you'))
                ->latest()->get();
            return $destinations;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getDestinationByCityId($id, $user_id)
    {
        try {
            $destinations = Destination::with(['reviews.user'])->where('city_id', $id)->select('destinations.*')
                ->selectSub(function ($query) {
                    $query->selectRaw('round(avg(star), 2)')
                        ->from('review_destinations')
                        ->whereColumn('destination_id', 'destinations.id');
                }, 'average_rating')
                ->leftJoin('saved_destinations', function ($join) use ($user_id) {
                    $join->on('destinations.id', '=', 'saved_destinations.destination_id')
                        ->where('saved_destinations.created_by', '=', $user_id);
                })
                ->addSelect(DB::raw('CASE WHEN saved_destinations.id IS NULL THEN false ELSE true END AS save_by_you'))
                ->latest()->get();
            return $destinations;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
