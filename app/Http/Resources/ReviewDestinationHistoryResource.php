<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewDestinationHistoryResource extends JsonResource
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
            "star" => $this->star,
            "description" => $this->description,
            "destination" => new DestinationResource($this->destination),
            "updated_at" => $this->updated_at->format('Y-m-d H:i:s'),
            "created_at" => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
