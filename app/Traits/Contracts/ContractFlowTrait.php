<?php

namespace App\Traits\Contracts;

use App\Models\Commons\Logs;
use Illuminate\Support\Facades\DB;

trait ContractFlowTrait {

    public function close()
    {
        $this->update([
            'status'        => self::$_STATUS_CLOSED_,
        ]);
	    Logs::onChangeStatus([
		    'table' => $this->table,
		    'pk'    => $this->id,
		    'sk'    => self::$_STATUS_CLOSED_,
	    ]);
        return true;
    }

    public function cancel()
    {
        $this->update([
            'status'        => self::$_STATUS_CANCELED_,
        ]);

	    Logs::onChangeStatus([
		    'table' => $this->table,
		    'pk'    => $this->id,
		    'sk'    => self::$_STATUS_CANCELED_,
	    ]);
        return true;
    }

    public function reopen()
    {
        $this->update([
            'status'        => self::$_STATUS_OPENNED_,
        ]);

	    Logs::onChangeStatus([
		    'table' => $this->table,
		    'pk'    => $this->id,
		    'sk'    => self::$_STATUS_OPENNED_,
	    ]);
        return true;
    }

}