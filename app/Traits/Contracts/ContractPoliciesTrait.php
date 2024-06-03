<?php

namespace App\Traits\Contracts;

use Illuminate\Support\Facades\Auth;

trait ContractPoliciesTrait {

	public function canDestroy()
	{
		return ($this->getAttribute('status') == self::$_STATUS_CANCELED_);
	}

	public function canShowDestroyBtn()
	{
		return $this->canDestroy();
	}

	public function canShowEditBtn()
	{
		return !$this->isClosed();
	}

	public function canShowRecalcValueBtn()
	{
        $u = Auth::user()->can('recalc');
        return ($u && !$this->isClosed());
	}

	public function canShowReopenBtn()
	{
        $u = Auth::user()->can('reopen');
        return ($u && $this->isClosed());
	}

	public function canShowCloseBtn()
	{
        $u = Auth::user()->can('close');
        return ($u && !$this->isClosed());
	}

	public function canShowCancelBtn()
	{
        $u = Auth::user()->can('cancel');
        return ($u && $this->getAttribute('status') != ContractStatusTrait::$_STATUS_CANCELED_);
	}

	public function canShowDeleteBtn()
	{
        $u = Auth::user()->can('delete');
		return ($u && ($this->isClosed() ||
                ($this->getAttribute('status') == ContractStatusTrait::$_STATUS_OPENNED_)));
	}

	//==================================================================

	public function canShowAddItemBtn()
	{
        $u = Auth::user()->can('add_itens');
		return ($u && $this->getAttribute('status') == ContractStatusTrait::$_STATUS_OPENNED_);
	}

	public function canShowEditItemBtn()
	{
        $u = Auth::user()->can('edit_itens');
		return ($u && $this->getAttribute('status') == ContractStatusTrait::$_STATUS_OPENNED_);
	}

	public function canShowDeleteItemBtn()
	{
        $u = Auth::user()->can('delete_itens');
		return ($u && $this->getAttribute('status') == ContractStatusTrait::$_STATUS_OPENNED_);
	}

}
