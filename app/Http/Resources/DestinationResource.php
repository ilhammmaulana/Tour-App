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
            "name" => $this->name,
            "description" => $this->description,
            "image" => url($this->image),
            "address" => $this->address,
            "longitude" => $this->longitude,
            "latitude" => $this->latitude,
            "updated_at" => $this->updated_at->format('Y-m-d H:i:s'),
            "created_at" => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
