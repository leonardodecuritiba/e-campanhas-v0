<?php

namespace App\Observers\Commons;

use App\Models\Commons\ExpenseType;
use Illuminate\Http\Request;

class ExpenseTypeObserver {

	protected $request;
	protected $table = 'expense_types';

	public function __construct( Request $request ) {
		$this->request = $request;
	}
	/**
	 * Listen to the Provider created event.
	 *
	 * @param ExpenseType $expense_type
	 *
	 *
	 * @return void
	 */
	public function creating( ExpenseType $expense_type ) {

	}


	/**
	 * Listen to the ExpenseType updating event.
	 *
	 * @param ExpenseType $expense_type
	 *
	 * @return void
	 */
	public function saving( ExpenseType $expense_type ) {

	}
	/**
	 * Listen to the Provider deleting event.
	 *
	 * @param ExpenseType $expense_type
	 *
	 * @return void
	 */
	public function deleting( ExpenseType $expense_type ) {
        $expense_type->expenses->each(function($p){
            $p->delete();
        });

	}
}
