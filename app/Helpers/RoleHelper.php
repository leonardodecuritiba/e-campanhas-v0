<?php

namespace App\Helpers;

class RoleHelper {

    static public function hasRole( $value )
    {
        $role = config('auth.role') ;
        return (is_array($value)) ? in_array($role, $value) : ($role == $value);
    }
}
