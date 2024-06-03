<?php

namespace App\Traits\Expenses;
use App\Models\Commons\ExpenseStatus;
use Illuminate\Support\Facades\Auth;

trait ExpensePoliciesTrait {

    public function canDestroy():bool
    {
        return Auth::user()->can('expenses.delete');
    }

    public function canAddAttachments():bool
    {
        return ($this->getAttribute('status') != ExpenseStatus::$_STATUS_APPROVED_) &&
            Auth::user()->can('expenses.attachments.create');
    }

    public function canRemAttachments():bool
    {
        return ($this->getAttribute('status') != ExpenseStatus::$_STATUS_APPROVED_) &&
            Auth::user()->can('attachments.destroy');
    }


    public function canAddObservations():bool
    {
        return ($this->getAttribute('status') != ExpenseStatus::$_STATUS_APPROVED_) &&
            Auth::user()->can('expenses.observations.create');
    }

    public function canRemObservations():bool
    {
        return ($this->getAttribute('status') != ExpenseStatus::$_STATUS_APPROVED_) &&
            Auth::user()->can('expenses.observations.delete');
    }

    public function canGenerateRecurrency():bool
    {
        return ($this->getAttribute('status') != ExpenseStatus::$_STATUS_APPROVED_) &&
            ($this->isMain());
    }

    public function canDuplicate():bool
    {
        return Auth::user()->can('expenses.duplicate');
    }

	public function canPay()
	{
		return ($this->getAttribute('status') == ExpenseStatus::$_STATUS_APPROVED_) &&
            (Auth::user()->can('expenses.pay')) &&
            ($this->getAttribute('paid_at') == NULL);
	}

	public function canSendToApprove()
	{
        //Só envia despesa para aprovação, caso a despesa pai esteja aprovada.
        $main = true;
        if(!$this->isMain()){
            $main = $this->parent->isApproved();
        }
		return $main && ($this->getAttribute('status') == ExpenseStatus::$_STATUS_OPENNED_ ||
            $this->getAttribute('status') == ExpenseStatus::$_STATUS_CANCELED_) &&
            (Auth::user()->can('expenses.send_to_approve'));
	}

	public function canUnapprove()
	{
		return ($this->getAttribute('status') == ExpenseStatus::$_STATUS_IN_APPROVATION_) &&
            Auth::user()->can('expenses.approve');
	}

    public function canCancel()
    {
        return ($this->getAttribute('status') == ExpenseStatus::$_STATUS_IN_APPROVATION_) &&
            Auth::user()->can('expenses.cancel');
    }

    public function canApprove()
    {
        return ($this->getAttribute('status') == ExpenseStatus::$_STATUS_IN_APPROVATION_) &&
            Auth::user()->can('expenses.approve');
    }

    public function isApproved()
    {
        return ($this->getAttribute('status') == ExpenseStatus::$_STATUS_APPROVED_);
    }

}
