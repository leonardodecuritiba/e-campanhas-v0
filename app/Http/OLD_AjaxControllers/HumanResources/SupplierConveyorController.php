<?php

namespace App\Http\OLD_AjaxControllers\HumanResources;

use App\Helpers\DataHelper;
use App\Http\OLD_AjaxControllers\Controller;
use App\Http\Resources\HumanResources\SupplierConveyorResource;
use App\Models\HumanResources\Supplier;
use App\Models\Moviments\Conveyor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SupplierConveyorController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 *
	 * @return AnonymousResourceCollection
     */

	public function index(Request $request) {
        $squery = Supplier::query();
        if($request->has("ids")){
            $squery->whereIn('id',$request->get("ids"));
        } else if($request->has("query")){
            $q = $request->get("query");
            $squery->where('social_reason','like','%'.$q.'%')
                ->orWhere(function($qr) use ($q){
                    $q = DataHelper::getOnlyNumbers($q);
                    return $qr->where('cpf','like','%'.$q.'%')
                        ->orWhere('cnpj','like','%'.$q.'%');
                });
        }
        $cquery = Conveyor::query();
        if($request->has("ids")){
            $cquery->whereIn('id',$request->get("ids"));
        } else if($request->has("query")){
            $q = $request->get("query");
            $cquery->where('social_reason','like','%'.$q.'%')
                ->orWhere('initials','like','%'.$q.'%')
                ->orWhere(function($qr) use ($q){
                    $q = DataHelper::getOnlyNumbers($q);
                    return $qr->where('cpf','like','%'.$q.'%')
                        ->orWhere('cnpj','like','%'.$q.'%');
                });
        }

        $merged = $squery->get()->merge($cquery->get()); // Contains foo and bar.

        return SupplierConveyorResource::collection($merged);
	}
}
