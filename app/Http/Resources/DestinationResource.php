<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DestinationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "image" => url($this->image),
            "address" => $this->address,
            "category_destination_id" => $this->category_id,
            "save_by_you" => $this->save_by_you == 1 ? true : false,
            "average_rating" => $this->average_rating,
            "reviews" => ReviewResource::collection($this->reviews),
            "city_id" => $this->city_id,
            "province_id" => $this->province_id,
            "longitude" => $this->longitude,
            "latitude" => $this->latitude,
            "updated_at" => $this->updated_at->format('Y-m-d H:i:s'),
            "created_at" => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
