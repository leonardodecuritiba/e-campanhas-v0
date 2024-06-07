<?php

namespace App\Traits\Commons;

use App\Helpers\DataHelper;

trait DateTimeTrait {

    public function getCreatedAtTimeFormattedAttribute()
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

    public function getCreatedAtFullFormattedAttribute()
    {
        return DataHelper::getFullPrettyDateTime($this->getAttribute('created_at'));
    }

    public function getDeletedAtTimeAttribute()
    {
        return strtotime( $this->getAttribute('deleted_at') );
    }

    public function getDeletedAtFormattedAttribute()
    {
        return DataHelper::getPrettyDateTime( $this->getAttribute('deleted_at') );
    }
}
