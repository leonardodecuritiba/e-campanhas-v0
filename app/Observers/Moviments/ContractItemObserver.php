<?php

namespace App\Observers\Moviments;

use App\Models\Commons\Logs;
use App\Models\Moviments\ContractItem;
use App\Models\Moviments\Settings\ServiceTypes;
use Illuminate\Http\Request;

class ContractItemObserver {

	protected $request;
	protected $table = 'contract_items';

	public function __construct( Request $request ) {
		$this->request = $request;
	}
	/**
	 * Listen to the Provider created event.
	 *
	 * @param ContractItem $contract_item
	 *
	 * @return void
	 */
	public function creating( ContractItem $contract_item ) {
	}
	/**
	 * Listen to the Provider created event.
	 *
	 * @param ContractItem $contract_item
	 *
	 * @return void
	 */
	public function created( ContractItem $contract_item )
	{
		Logs::onCreate([
//			'table' => $this->table,
			'table' => 'contracts',
			'pk'    => $contract_item->contract_id,
			'sk'    => $contract_item->id,
		]);
		$contract_item->contract->updateFreight();
	}


	/**
	 * Listen to the Client updating event.
	 *
	 * @param ContractItem $contract_item
	 *
	 * @return void
	 */
	public function updating( ContractItem $contract_item ) {

        if($contract_item->isDirty('service_type')){
            Logs::onUpdate([
                'table'         => 'contracts',
                'pk'            => $contract_item->contract_id,
                'sk'            => $contract_item->id,
                'description'   => [
                   "Tipo de Serviço" => [
                        "old" => ServiceTypes::whereId($contract_item->getOriginal('service_type'))->description,
                        "new" => ServiceTypes::whereId($contract_item->getAttribute('service_type'))->description,
                    ]
                ],
            ]);

        }

//		dd($this->request->all());
//		if($this->request->has('contract_partner_type')){
//			$partner_id = $this->request->get('contract_partner_type');
//			if($partner_id == 1){
//				$contract_item->vehicle_id =$this->request->get('partner_id');
//				$contract_item->conveyor_id =NULL;
//			} else if($partner_id == 2){
//				$contract_item->conveyor_id =$this->request->get('partner_id');
//				$contract_item->vehicle_id =NULL;
//			}
//		}
//		dd($this->request->all());
    }
	/**
	 * Listen to the Provider deleting event.
	 *
	 * @param ContractItem $contract_item
	 *
	 * @return void
	 */
	public function deleting( ContractItem $contract_item ) {
		Logs::onDelete([
//			'table' => $this->table,
			'table' => 'contracts',
			'pk'    => $contract_item->contract_id,
			'sk'    => $contract_item->id,
		]);
	}
	/**
	 * Listen to the Provider deleting event.
	 *
	 * @param ContractItem $contract_item
	 *
	 * @return void
	 */
	public function deleted( ContractItem $contract_item ) {
	    $contract = $contract_item->contract;
        $contract->updateItemValues();
        $contract->updateFreight();
	}
}
