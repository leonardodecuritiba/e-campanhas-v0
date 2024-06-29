<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\View;
use Symfony\Component\Console\Application;

class MapController extends Controller {

    public $entity = "maps";
    public $sex = "M";
    public $name = "Mapa";
    public $names = "Mapas";
    public $main_folder = '';
    public $page = [];

    public function __construct( Route $route )
    {
        parent::__construct();
        $this->page = (object) [
            'entity'      => $this->entity,
            'main_folder' => $this->main_folder,
            'name'        => $this->name,
            'names'       => $this->names,
            'sex'         => $this->sex,
            'auxiliar'    => array(),
            'response'    => array(),
            'has_menu'    => 1,
            'page_title'  => $this->names,
            'title'       => $this->names,
            'subtitle'    => $this->names,
            'create_option' => 0,
            'noresults'   => '',
            'tab'         => 'data',
            'breadcrumb'  => array(),
        ];
        $this->breadcrumb( $route );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */

    public function index()
    {
        return view('pages.maps.index' )
            ->with( 'Page', $this->page );
    }
}
