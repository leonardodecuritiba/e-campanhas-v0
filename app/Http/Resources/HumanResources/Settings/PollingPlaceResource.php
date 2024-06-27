<?php

namespace App\Http\Resources\HumanResources\Settings;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PollingPlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request) :array
    {
        return [
            'id' => $this->resource,
            'text' => $this->resource
        ];
    }
}
