<?php

namespace App\Helpers;


use Illuminate\Support\Facades\Route;

class MenuHelper {

    static public function isRoute( $value )
    {
        $route = optional(Route::current())->getName();
        if(is_array($value)){
            return in_array($route, $value);
        }
        return ($route == $value);
    }
}
