<?php

namespace App\Http\Controllers\HumanResources\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\HumanResources\Settings\CepCityRequest;
use App\Http\Resources\HumanResources\Settings\CepCityResource;
use App\Models\Commons\CepCity;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CepCityController extends Controller {

	/**
	 * gET the specified resource from storage.
	 *
	 * @return AnonymousResourceCollection
     */
	public function index(CepCityRequest $request) //: AnonymousResourceCollection
    {
        $query = CepCity::findOrFailByStateId($request->state_id);
        return CepCityResource::collection($query->get());
	}
}
