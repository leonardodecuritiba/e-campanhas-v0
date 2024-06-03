<?php

namespace App\Traits;

use App\Helpers\DataHelper;

trait DateTimeTrait {

    public function getCreatedAtTimeAttribute()
    {
        return strtotime( $this->getAttribute('created_at') );
    }

    public function getCreatedAtFormattedAttribute()
    {
        return DataHelper::getPrettyDateTime( $this->getAttribute('created_at') );
    }

    public function getCreatedAtHumanFormattedAttribute()
    {
        return DataHelper::getHumanDateTime( $this->getAttribute('created_at') );
    }

    public function getDeletedAtTimeAttribute()
    {
        return strtotime( $this->getAttribute('deleted_at') );
    }

    public function getDeletedAtFormattedAttribute()
    {
        return DataHelper::getPrettyDateTime( $this->getAttribute('deleted_at') );
    }

    public function getPaidAtTimeAttribute()
    {
        return strtotime( $this->getAttribute('paid_at') );
    }

    public function getPaidAtFormattedAttribute()
    {
        return DataHelper::getPrettyDate( $this->getAttribute('paid_at') );
    }

    public function getEndAtTimeAttribute()
    {
        return strtotime( $this->getAttribute('end_at') );
    }

    public function getEndAtFormattedAttribute()
    {
        return DataHelper::getPrettyDateTime( $this->getAttribute('end_at') );
    }

    public function getCreatedAtFullFormattedAttribute()
    {
        return DataHelper::getFullPrettyDateTime( $this->getAttribute('created_at') );
    }

    public function getFinishedAtTimeAttribute()
    {
        return strtotime( $this->getAttribute('finished_at') );
    }

    public function getFinishedAtFormattedAttribute()
    {
        return DataHelper::getPrettyDateTime( $this->getAttribute('finished_at') );
    }

    public function getFinishedAtFullFormattedAttribute()
    {
        return DataHelper::getFullPrettyDateTime( $this->getAttribute('finished_at') );
    }


    //============================================================
    //======================== PORTION ===========================
    //============================================================

    public function getDueAtFormattedAttribute()
    {
        return DataHelper::getPrettyDate( $this->getAttribute('due_at') );
    }

    public function getDueAtTimeAttribute()
    {
        return strtotime( $this->getAttribute('due_at') );
    }

    public function getSettedAtFormattedAttribute()
    {
        return DataHelper::getPrettyDate( $this->getAttribute('setted_at') );
    }

    public function getSettedAtTimeAttribute()
    {
        return strtotime( $this->getAttribute('setted_at') );
    }

    public function getDueTimeAttribute()
    {
        return strtotime( $this->getAttribute('due') );
    }

    public function getDueFormattedAttribute()
    {
        return DataHelper::getPrettyDate( $this->getAttribute('due') );
    }
}
