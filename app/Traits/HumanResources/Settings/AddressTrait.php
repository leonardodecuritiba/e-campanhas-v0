<?php

namespace App\Traits\HumanResources\Settings;

use App\Traits\Commons\StringTrait;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

trait AddressTrait {

    use SpatialTrait;

    public function getFullStreetAttribute()
    {
        $street = '';
        $street .= ($this->attributes['street'] != '') ? $this->attributes['street'] : '';
        $street .= ($this->attributes['number'] != '') ? ', ' . $this->attributes['number'] : ', s/n';
        return $street;
    }

    public function getCityNameAttribute(  )
    {
        return optional($this->city)->name;
    }

    public function getUfNameAttribute(  )
    {
        return optional($this->state)->short_name;
    }

    public function getCityUfAttribute()
    {
        $city = ($this->city_name != NULL) ? $this->city_name : "*Sem cidade";
        $uf = ($this->uf_name != NULL) ? $this->uf_name : "*Sem UF";
        return $city . ' / ' . $this->uf_name;
    }

    public function getZipFormattedAttribute()
    {
        return StringTrait::mask( $this->attributes['zip'], '#####-###' );
    }

    /*
     * Setters
     */
    public function setZipAttribute( $value )
    {
        return $this->attributes['zip'] = StringTrait::getOnlyNumbers( $value );
    }


    // Accessor for latitude
    public function getLatitudeAttribute()
    {
        return $this->geolocalization ? $this->geolocalization->getLat() : null;
    }

    // Accessor for longitude
    public function getLongitudeAttribute()
    {
        return $this->geolocalization ? $this->geolocalization->getLng() : null;
    }

    /*
	public function getFullAddress()
    {
		return $this->getFullStreetComplement() . ', ' . $this->getCityUfAttribute();
	}

	public function getFullDistrictAttribute()
    {
		return ($this->attributes['district'] != '') ? ' - ' . $this->attributes['district'] : 'sem bairro';;
	}

	public function getFullStreetComplement()
    {
		$street = $this->getFullStreet();
		return $street . ($this->attributes['complement'] != NULL) ? ' - ' . $this->attributes['complement'] : '';
	}

	public function checkCityName($value)
    {
		$o = StringTrait::removeAccents($this->city->name);
		$value = StringTrait::removeAccents($value);
		return (strcasecmp ( $o , $value ) == 0);
	}

	public function checkUFName($value)
    {
		$o = StringTrait::removeAccents($this->state->short_name);
		$value = StringTrait::removeAccents($value);
		return (strcasecmp ( $o , $value ) == 0);
	}
    */

}