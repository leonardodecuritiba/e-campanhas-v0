<?php

namespace App\Http\AjaxControllers;

use App\Http\Controllers\Controller as MasterController;

class Controller extends MasterController {

    public function __construct(  ) {
        $this->middleware( 'auth' );
    }
}
