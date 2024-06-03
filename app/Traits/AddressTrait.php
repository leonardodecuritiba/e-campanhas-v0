<?php

namespace App\Traits;

use App\Helpers\DataHelper;

trait AddressTrait {

	public function getFormatedZip() {
		return DataHelper::mask( $this->attributes['zip'], '#####-###' );
	}

	public function getFullAddress() {
		return $this->getFullStreetComplement() . ', ' . $this->getCityUfAttribute();
	}

	public function getFullStreet() {
		$street = '';
		$street .= ($this->attributes['street'] != '') ? $this->attributes['street'] : '';
		$street .= ($this->attributes['number'] != '') ? ', ' . $this->attributes['number'] : ', s/n';
		return $street;
	}

	public function getFullDistrict() {
		return ($this->attributes['district'] != '') ? ' - ' . $this->attributes['district'] : 'sem bairro';;
	}

	public function getFullStreetComplement() {
		$street = $this->getFullStreet();
		return $street . ($this->attributes['complement'] != NULL) ? ' - ' . $this->attributes['complement'] : '';
	}

//	public function getCreatedAtAttribute( $value ) {
//		return DataHelper::getPrettyDateTime( $value );
//	}

	public function setZipAttribute( $value ) {
		return $this->attributes['zip'] = DataHelper::getOnlyNumbers( $value );
	}

	public function getCityNameAttribute(  ) {
		return optional($this->city)->name;
	}

	public function getUfNameAttribute(  ) {
		return optional($this->state)->short_name;
	}
	public function getCityUfAttribute(  )
    {
        $city = ($this->city_name != NULL) ? $this->city_name : "*Sem cidade";
        $uf = ($this->uf_name != NULL) ? $this->uf_name : "*Sem UF";
		return $city . ' / ' . $this->uf_name;
	}

	public function checkCityName($value) {
		$o = DataHelper::removeAccents($this->city->name);
		$value = DataHelper::removeAccents($value);
		return (strcasecmp ( $o , $value ) == 0);
	}

	public function checkUFName($value) {
		$o = DataHelper::removeAccents($this->state->short_name);
		$value = DataHelper::removeAccents($value);
		return (strcasecmp ( $o , $value ) == 0);
	}

}