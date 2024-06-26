<?php

namespace App\Traits\HumanResources\User;

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

    public function getShortNameAttribute()
    {
        return Str::limit($this->getName(), 20 );
    }

    public function getShortDescriptionAttribute()
    {
        return $this->short_name;
    }

    public function updatePassword( $password )
    {
        $this->password = bcrypt( $password );
        return $this->save();
    }

    //ROLES
    public function getRoleNameAttribute()
    {
        return $this->getRoleNames()->first();
    }

    public function is( $name = null )
    {
        $role = $this->role_name;
        return ( $name == null ) ? $role : ( $role == $name );
    }

    public function getRoleId()
    {
        return $this->roles->first()->id;
    }

    public function itsMe($id)
    {
        return ($this->id == $id);
    }

    public function getRoleNameFormattedAttribute()
    {
        switch ($this->role_name){
            case 'root':
                return 'Root';
            case 'admin':
                return 'Administrador';
            case 'coordinator':
                return 'Coordenador';
            case 'registrar':
                return 'Cabo Eleitoral';
        }
    }

    /**
     * Revoke the given role from the model.
     *
     * @return int
     */
    public function detachRoles(): int
    {
        return $this->roles()->detach();
    }

}
