<?php

namespace App\Traits\OLD;

trait AddressRelashionshipTrait {

	public function checkUFName($value) {
		return $this->address->checkUFName($value);
	}

	public function checkCityName($value) {
		return $this->address->checkCityName($value);
	}


}