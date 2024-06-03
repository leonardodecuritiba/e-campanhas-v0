<?php

namespace App\Http\Resources\Commons;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VariableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this["id"],
            'text' => $this["description"]
        ];
    }
}
