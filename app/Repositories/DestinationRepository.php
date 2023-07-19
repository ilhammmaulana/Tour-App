<?php

namespace App\Repositories;

use App\Models\CategoryDestination;
use App\Models\Destination;
use App\Models\SavedDestination;
use Illuminate\Support\Facades\DB;

interface DestinationRepositoryInterface
{
    public function getAllDestinationsWithSave();
    public function assignSaveDestination($destination_id, $created_by);
}

class DestinationRepository
{
    public function getAllDestinationsWithSave($user_id)
    {
        try {
            $destinations = Destination::select('destinations.*')
                ->leftJoin('saved_destinations', function ($join) use ($user_id) {
                    $join->on('destinations.id', '=', 'saved_destinations.destination_id')
                        ->where('saved_destinations.created_by', '=', $user_id);
                })
                ->addSelect(DB::raw('CASE WHEN saved_destinations.id IS NULL THEN false ELSE true END AS save_by_you'))
                ->get();

            return $destinations;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getDestinationCategroies()
    {
        try {
            $categories = CategoryDestination::all();
            return $categories;
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
    public function getHisotrySaveDestination($user_id)
    {
        $savedDestinations = SavedDestination::with('destination')
            ->where('created_by', $user_id)
            ->get();
        return $savedDestinations->pluck('destination');;
    }
}
