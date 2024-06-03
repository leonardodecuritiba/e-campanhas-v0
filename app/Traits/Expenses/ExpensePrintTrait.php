<?php

namespace App\Traits\Expenses;


use App\Helpers\PrintHelper;

trait ExpensePrintTrait {

    static public function print($id)
    {
        $expense = self::with('expense_type', 'supplier', 'owner')->findOrFail( $id);
        return PrintHelper::printExpense($expense);
    }

}