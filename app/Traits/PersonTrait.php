<?php

namespace App\Traits;

use App\Helpers\DataHelper;
use App\Models\HumanResources\Settings\Address;
use App\Models\HumanResources\Settings\Contact;

trait PersonTrait
{
    //============================================================
    //======================== ACCESSORS =========================
    //============================================================

    public function getName()
    {
        return $this->document_formatted . ' - ' . $this->getAttribute(self::$name_field);
    }

    public function getShortDescriptionAttribute()
    {
        return $this->getName();
    }

    public function isLegalPerson()
    {
        return $this->getAttribute('type') == 0;
    }

    public function getDocumentFormattedAttribute()
    {
        return $this->isLegalPerson() ? $this->cpf_formatted : $this->cnpj_formatted;
    }

    public function getCpfFormattedAttribute()
    {
        return DataHelper::mask($this->getAttribute('cpf'), '###.###.###-##');
    }

    public function getCnpjFormattedAttribute()
    {
        return DataHelper::mask($this->getAttribute('cnpj'), '##.###.###/####-##');
    }


    //============================================================
    //======================== MUTATORS ==========================
    //============================================================

    public function setCnpjAttribute($value)
    {
        return $this->attributes['cnpj'] = DataHelper::getOnlyNumbers($value);
    }

    public function setCpfAttribute($value)
    {
        return $this->attributes['cpf'] = DataHelper::getOnlyNumbers($value);
    }

    //============================================================
    //======================== BELONGS ===========================
    //============================================================
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
