<?php

namespace App\Traits\Contracts\Settings;

trait TransferContractStatusTrait {

    static $_STATUS_UNCONVERTED_ = 0;
    static $_STATUS_CONVERTED_ = 1;

	static public function getAllStatustoSelectList()
	{
		return [
			'0'  => 'NÃO CONVERTIDA',
			'1'  => 'CONVERTIDA',
		];
	}

	public function getTransferContractStatusArrayAttribute()
	{
		return [
			'text'  => $this->getTransferContractStatusTextAttribute(),
			'color' => $this->getTransferContractStatusColorAttribute(),
		];
	}

    public function getTransferContractStatusColorAttribute()
    {
        return $this->getTransferContractStatusColor(
            $this->getAttribute('transfer_contract_status')
        );
    }

    public function getTransferContractStatusTextAttribute()
    {
        return $this->getTransferContractStatusText(
            $this->getAttribute('transfer_contract_status')
        );
    }

    static public function getTransferContractStatusText($value)
    {
	    switch($value){
		    case self::$_STATUS_UNCONVERTED_:
		    	return 'NÃO CONVERTIDA';
            case self::$_STATUS_CONVERTED_:
                return 'CONVERTIDA';
	    }
    }

    static public function getTransferContractStatusColor($value)
    {
	    switch($value){
		    case self::$_STATUS_UNCONVERTED_:
			    return 'danger';
		    case self::$_STATUS_CONVERTED_:
			    return 'success';
	    }
    }

}