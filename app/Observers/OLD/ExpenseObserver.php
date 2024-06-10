<?php

namespace App\Observers\OLD;

use App\Models\Commons\Expense;
use App\Models\Commons\ExpenseStatus;
use App\Models\Commons\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseObserver {

	protected $request;
	protected $table = 'expenses';

	public function __construct( Request $request )
    {
		$this->request = $request;
	}
	/**
	 * Listen to the Provider created event.
	 *
	 * @param Expense $expense
	 *
	 *
	 * @return void
	 */
	public function creating( Expense $expense )
    {
        $expense->setAttribute('owner_id', Auth::id());
        if($this->request->has('supplier_type')){
            $expense->supplier_type = true;
            $expense->supplier_id = NULL;
        } else {
            $expense->supplier_type = false;
            $expense->conveyor_id = NULL;
        }
	}

    /**
     * Listen to the Provider created event.
     *
     * @param Expense $expense
     *
     * @return void
     */
    public function created( Expense $expense )
    {
        Logs::onCreate([
            'table' => $this->table,
            'pk'    => $expense->id,
        ]);
    }

	/**
	 * Listen to the Expense updating event.
	 *
	 * @param Expense $expense
	 *
	 * @return void
	 */
	public function saving( Expense $expense )
    {
        if (count($this->request->all())) {
            if($this->request->has('supplier_type')){
                $expense->supplier_type = true;
                $expense->supplier_id = NULL;
            } else {
                $expense->supplier_type = false;
                $expense->conveyor_id = NULL;
            }
        }
	}
	/**
	 * Listen to the Provider deleting event.
	 *
	 * @param Expense $expense
	 *
	 * @return void
	 */
	public function deleting( Expense $expense )
    {
        $expense->children->each(function($p){
            $p->delete();
        });
        $expense->observations->each(function($p){
            $p->delete();
        });
        $expense->attachments->each(function($p){
            $p->delete();
        });

	}
}
