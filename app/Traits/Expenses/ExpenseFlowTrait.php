<?php

namespace App\Traits\Expenses;

use App\Models\Commons\Logs;
use App\Models\Commons\ExpenseStatus;
use Illuminate\Support\Facades\Auth;

trait ExpenseFlowTrait {

    public function sendToApprove()
    {
        $this->update([
            'status'        => ExpenseStatus::$_STATUS_IN_APPROVATION_,
        ]);
        Logs::onUpdate([
            'table'         => $this->table,
            'pk'            => $this->id,
            'sk'            => ExpenseStatus::$_STATUS_IN_APPROVATION_,
            'description'   => "Despesa enviada para aprovação!",
        ]);
        return true;
    }

    public function unapprove( $justification )
    {
        $this->update([
            'status'        => ExpenseStatus::$_STATUS_OPENNED_,
        ]);
        $description = "Despesa não aprovada!";
        if($justification != NULL){
            $description .= " Justificativa: ".$justification;
        } else {
            $description .= " Justificativa não apresentada.";
        }
        Logs::onUpdate([
            'table'         => $this->table,
            'pk'            => $this->id,
            'sk'            => ExpenseStatus::$_STATUS_OPENNED_,
            'description'   => $description,
        ]);
        return true;
    }

    public function cancel( $justification )
    {
        $this->update([
            'status'        => ExpenseStatus::$_STATUS_CANCELED_,
        ]);
        $description = "Aprovação de Despesa cancelada!";
        if($justification != NULL){
            $description .= " Justificativa: ".$justification;
        } else {
            $description .= " Justificativa não apresentada.";
        }
        Logs::onUpdate([
            'table'         => $this->table,
            'pk'            => $this->id,
            'sk'            => ExpenseStatus::$_STATUS_CANCELED_,
            'description'   => $description,
        ]);
        return true;
    }

    public function approve()
    {
        $this->update([
            'approver_id'   => Auth::id(),
            'status'        => ExpenseStatus::$_STATUS_APPROVED_,
        ]);
        Logs::onUpdate([
            'table'         => $this->table,
            'pk'            => $this->id,
            'sk'            => ExpenseStatus::$_STATUS_IN_APPROVATION_,
            'description'   => "Despesa aprovada!",
        ]);
        return true;
    }

}