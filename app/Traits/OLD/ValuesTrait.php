<?php

namespace App\Traits\OLD;

use App\Helpers\DataHelper;

trait ValuesTrait {

    public function getValueFormattedAttribute()
    {
        return DataHelper::getFloat2Real( $this->attributes['value'] );
    }

    public function getValueCurrencyAttribute()
    {
        return DataHelper::getFloat2Currency( $this->attributes['value'] );
    }

	public function setValueAttribute( $value )
	{
		$this->attributes['value'] = DataHelper::getReal2Float( $value );
	}

}
