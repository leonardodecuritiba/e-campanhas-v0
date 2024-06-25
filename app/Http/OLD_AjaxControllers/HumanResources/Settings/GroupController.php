<?php

namespace App\Http\OLD_AjaxControllers\HumanResources\Settings;

use App\Http\OLD_AjaxControllers\Controller;
use App\Http\Resources\HumanResources\Settings\GroupResource;
use App\Models\HumanResources\Settings\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GroupController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 *
	 * @return AnonymousResourceCollection
     */

	public function index(Request $request) {
        $query = Group::query();
        if($request->has("ids")){
            $query->whereIn('id',$request->get("ids"));
        } else if($request->has("query")){
            $query->where('description','like','%'.$request->get("query").'%');
        }
        return GroupResource::collection($query->get());
//		$data = Group::getAlltoTypeHeadList()->prepend(['id'=>-1, 'text'=>'Todos']);
//        return new JsonResponse( $data  );
	}
}
