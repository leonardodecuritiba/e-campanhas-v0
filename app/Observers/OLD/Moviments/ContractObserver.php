<?php

namespace App\Observers\OLD\Moviments;

use App\Models\Commons\Logs;
use App\Models\Moviments\Contract;
use App\Models\Tlog\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContractObserver {

	protected $request;
	protected $table = 'contracts';

	public function __construct( Request $request ) {
		$this->request = $request;
	}
	/**
	 * Listen to the Provider created event.
	 *
	 * @param Contract $contract
	 *
	 * @return void
	 */
	public function creating( Contract $contract )
    {
        $contract->owner_id = Auth::check() ? Auth::id() : NULL;
	}
	/**
	 * Listen to the Provider created event.
	 *
	 * @param Contract $contract
	 *
	 * @return void
	 */
	public function created( Contract $contract )
	{
		Logs::onCreate([
			'table' => $this->table,
			'pk'    => $contract->id,
		]);
		if(($this->request->has('transfer_id')) && ($this->request->has('pre_filled'))){
		    DB::connection('tlog')
                ->table('transfers')
                ->where('id', $this->request->get('transfer_id'))
                ->update(['transfer_contract_status' => 1]);
        }
	}


	/**
	 * Listen to the Client updating event.
	 *
	 * @param Contract $contract
	 *
	 * @return void
	 */
	public function saving( Contract $contract )
    {
        if($contract->launch_type && $this->request->has('partner_id'))
        {
            $contract->contract_partner_type = 2;
            $contract->conveyor_id = $this->request->get('partner_id');
            $contract->vehicle_id = NULL;
        } else {
            if($this->request->has('contract_partner_type'))
            {
                $partner_id = $this->request->get('contract_partner_type');
                if($partner_id == 1){
                    $contract->vehicle_id =$this->request->get('partner_id');
                    $contract->conveyor_id =NULL;
                } else if($partner_id == 2){
                    $contract->conveyor_id =$this->request->get('partner_id');
                    $contract->vehicle_id =NULL;
                }
            }
        }

		if($contract->id > 0){
			$fields = ['contracted_at','realized_at','value'];
			if($contract->isDirty($fields)){
				$values = NULL;
				foreach($fields as $f){
					if($contract->isDirty($f)){
						$values[$f] = [
							'old'   => $contract->getOriginal($f),
							'new'   => $contract->getAttribute($f)
						];
					}
				}
				Logs::onUpdate([
					'table'         => $this->table,
					'pk'            => $contract->id,
					'description'   => $values,
				]);
			}

            if($contract->value != $contract->getOriginal('value')){
                $contract->updateItemValues();
            }
		}


//		dd($this->request->all());
    }
	/**
	 * Listen to the Provider deleting event.
	 *
	 * @param Contract $contract
	 *
	 * @return void
	 */
	public function deleting( Contract $contract ) {
		$contract->items->each(function($p){
            $p->delete();
        });
	}
}
