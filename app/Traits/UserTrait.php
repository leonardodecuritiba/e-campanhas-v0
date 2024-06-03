<?php

/**
 * Created by PhpStorm.
 * User: rle
 * Date: 27/04/18
 * Time: 07:20
 */
namespace App\Traits;


use App\Helpers\DataHelper;
use Illuminate\Support\Str;

trait UserTrait
{

    public function getEmail()
    {
        return $this->getAttribute( 'email' );
    }

    public function getShortEmail()
    {
        return Str::limit($this->getEmail(), 20 );
    }

    public function getName()
    {
        return $this->getAttribute( 'name' );
    }

    public function updatePassword( $password )
    {
        $this->password = bcrypt( $password );
        return $this->save();
    }

    public function is( $name = null )
    {
        $role = $this->getRoleName();
        return ( $name == null ) ? $role : ( $role == $name );
    }

    public function getRoleName()
    {
        return $this->getRoleNames()->first();
    }

    public function getRoleId()
    {
        return $this->roles->first()->id;
    }

    public function itsMe($id)
    {
        return ($this->id == $id);
    }

    public function getTypeFormattedAttribute()
    {
        return ucfirst($this->getRoleName());
    }


    public function getCpfFormattedAttribute()
    {
        return DataHelper::mask( $this->attributes['cpf'], '###.###.###-##' );
    }

    public function getRgFormattedAttribute()
    {
        return DataHelper::mask( $this->attributes['rg'], '#.###.###-##' );
    }


    public function setCpfAttribute( $value )
    {
        return $this->attributes['cpf'] = DataHelper::getOnlyNumbers( $value );
    }
    public function setRgAttribute( $value )
    {
        return $this->attributes['rg'] = DataHelper::getOnlyNumbers( $value );
    }
}
