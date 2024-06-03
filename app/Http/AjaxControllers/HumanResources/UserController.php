<?php

namespace App\Http\AjaxControllers\HumanResources;

use App\Http\AjaxControllers\Controller;
use App\Http\Resources\HumanResources\UserResource;
use App\Models\HumanResources\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 *
	 * @return AnonymousResourceCollection
     */

	public function index(Request $request) {
        $query = User::query();
        if($request->has("ids")){
            $query->whereIn('id',$request->get("ids"));
        } else if($request->has("query")){
            $query->where('name','like','%'.$request->get("query").'%');
        }
        return UserResource::collection($query->get());
	}
}
