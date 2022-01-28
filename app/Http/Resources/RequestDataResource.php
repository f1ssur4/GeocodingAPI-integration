<?php

namespace App\Http\Resources;

use App\Models\RegionsCities;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestDataResource extends JsonResource
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
            'address' => $this->address,
            'regions_cities' => new RegionsCitiesResource($this->RegionsCities),

        ];
    }
}
