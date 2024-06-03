<?php

namespace App\Http\AjaxControllers\Commons;

use App\Helpers\DataHelper;
use App\Http\AjaxControllers\Controller;
use App\Models\Commons\CepCities;
use App\Models\Moviments\Commons\Entity;
use App\Models\Moviments\Commons\Receiver;
use App\Models\Moviments\Conveyor;
use App\Models\Moviments\Moviment;
use App\Models\Moviments\PriceTables\PriceRangeA;
use App\Models\Moviments\Settings\Generalities;
use App\Models\Moviments\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CommonsController extends Controller {
	/**
	 * gET the specified resource from storage.
	 *
	 * @return Response
	 */
	public function getStateCityToSelect(Request $request) {
		$state_id = $request->get( 'id' );
		return ( $state_id == null ) ? $state_id : CepCities::where( 'state_id', $state_id )->get();
	}


	/**
	 * Active the specified resource from storage.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function setActive(Request $request) {

		$model  = $request->get( 'model' );
		$id     = $request->get( 'id' );
		$Entity = $model::findOrFail( $id );

		return new JsonResponse( [
			'status'  => 1,
			'message' => $Entity->updateActive()
		], 200 );
	}

    public function getAjaxDataByID(Request $request) {
        $id      = $request->get('id');
        $table   = $request->get('table');
        $retorno = explode(',',$request->get('retorno'));

        $response = DB::table($table)
                      ->whereNull('deleted_at')
                      ->where('id', $id)
                      ->get($retorno);

        return response()->json([ 'status' => '1',
                                  'response' => $response
        ]);
    }


    public function ajaxSelect2(Request $request) {
        $id     = $request->get('id');
        $fk     = $request->get('fk');
        $field  = $request->get('field'); //status key
        $value  = $request->get('value'); //status key
        $table  = $request->get('table');
        $action = $request->get('action');
        if($value==NULL) return;
        $busca = NULL;
        switch($action){
            case 'get_by_id':
                $busca = DB::table($table)
                           ->whereNull('deleted_at')
                           ->where('id', $id)
                           ->get();
                break;
            case 'get_by_field':
                $busca = DB::table($table)
                           ->whereNull('deleted_at')
                           ->where($field,'like' , $value."%")
                           ->get();
                break;
            case 'busca_por_fk_campo':
                $busca = DB::table($table)
                           ->whereNull('deleted_at')
                           ->where($fk, $id)
                           ->where($field,'like' , $value . "%")
                           ->get();
                break;
        }
        $data = NULL;
        if( count($busca) > 0){
            foreach($busca as $i => $dt){
                $data[] = array( 'id' => $dt->id, 'text' => $dt->$field, 'data' => $dt);
            }
        }
        echo json_encode($data);
    }
}
