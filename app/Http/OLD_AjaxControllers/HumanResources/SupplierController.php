<?php

namespace App\Http\OLD_AjaxControllers\HumanResources;

use App\Http\OLD_AjaxControllers\Controller;
use App\Http\Resources\HumanResources\SupplierResource;
use App\Models\HumanResources\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SupplierController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 *
	 * @return AnonymousResourceCollection
     */

	public function index(Request $request) {
        $query = Supplier::query();
        if($request->has("ids")){
            $query->whereIn('id',$request->get("ids"));
        } else if($request->has("query")){
            $q = $request->get("query");
            $query->where('social_reason','like','%'.$q.'%')
                ->orWhere(function($qr) use ($q){
                    return $qr->where('cpf','like','%'.$q.'%')
                        ->orWhere('cnpj','like','%'.$q.'%');
                });
        }
        return SupplierResource::collection($query->get());
//		$data = Supplier::getAlltoTypeHeadList()->prepend(['id'=>-1, 'text'=>'Todos']);
//        return new JsonResponse( $data  );
	}
}
