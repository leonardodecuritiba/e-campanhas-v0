<?php

namespace App\Traits\HumanResources;

use App\Helpers\DataHelper;
use App\Traits\Commons\StringTrait;

trait VoterFieldsTrait {

    public function setBirthdayAttribute( $value ): ?string
    {
        return $this->attributes['birthday'] = DataHelper::setDate( $value );
    }

    public function setDeathDateAttribute( $value ): ?string
    {
        return $this->attributes['death_date'] = DataHelper::setDate( $value );
    }

    public function setCpfAttribute( $value )
    {
        return $this->attributes['cpf'] = DataHelper::getOnlyNumbers( $value );
    }

    public function setWhatsappAttribute( $value )
    {
        return $this->attributes['whatsapp'] = DataHelper::getOnlyNumbers( $value );
    }

    public function getBirthdayFormattedAttribute()
    {
        return DataHelper::getPrettyDate( $this->getAttribute('birthday') );
    }

    public function getDeathDateFormattedAttribute()
    {
        return DataHelper::getPrettyDate( $this->getAttribute('death_date') );
    }

//    public function getYearsFromBirthdayAttribute()
//    {
//        return DataHelper::diffForHumans( $this->getAttribute('birthday') );
//    }

    public function getYearsFromBirthdayAttribute()
    {
        return DataHelper::diffInYears( $this->getAttribute('birthday') );
    }
    public function getYearsFromDeathFormattedAttribute()
    {
        return DataHelper::diffForHumansFromDate( $this->getAttribute('death_date') );
    }

    public function getWhatsappFormattedAttribute( $value ): ?string
    {
        return StringTrait::mask( $this->attributes['whatsapp'], '+55 (##) #####-####' );
    }

    public function getCpfFormattedAttribute()
    {
        return StringTrait::mask($this->getAttribute('cpf'), '###.###.###-##');
    }

}
