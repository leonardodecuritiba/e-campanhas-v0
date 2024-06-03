<?php

namespace App\Http\AjaxControllers\HumanResources\Settings;

use App\Http\AjaxControllers\Controller;
use App\Models\HumanResources\Settings\Group;
use Illuminate\Http\Request;

class EntityGroupController extends Controller {

	/**
	 * Update the specified resource in storage.
	 *
	 * @param $group_id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function attach( $group_id, Request $request ) {
		$entity_id = $request->get('entity_id');
		$group = Group::findOrFail($group_id);
		if($group->entities()->where('entity_id',$entity_id)->count() == 0){
			$group->entities()->attach($entity_id);
			$entity = $group->entities()->where('entity_id',$entity_id)->first();
			return response()->success( 'Cliente adicionado com sucesso!', $entity );
		}
		return response()->error( 'Cliente já foi adicionado a este grupo!' );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param $group_id
	 * @param $entity_id
	 *
	 * @return Response
	 */
	public function dettach( $group_id, $entity_id ) {
		$group = Group::findOrFail($group_id);
		if($group->entities()->where('entity_id',$entity_id)->count() > 0){
			$group->entities()->detach($entity_id);
			return response()->success( 'Cliente removido com sucesso!', $entity_id );
		}
		return response()->error( 'Cliente já foi removido deste grupo!' );
	}

}