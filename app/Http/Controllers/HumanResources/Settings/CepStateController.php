<?php

namespace App\Http\Controllers\HumanResources\Settings;

use App\Http\Controllers\Controller;
use App\Http\Resources\HumanResources\Settings\CepStateResource;
use App\Models\Commons\CepState;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CepStateController extends Controller {

	/**
	 * gET the specified resource from storage.
	 *
	 * @return AnonymousResourceCollection
     */
	public function index(): AnonymousResourceCollection
    {
        $query = CepState::query();
        return CepStateResource::collection($query->get());
	}
}
