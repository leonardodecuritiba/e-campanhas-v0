<?php

namespace App\Http\Controllers\HumanResources\Settings;

use App\Http\Controllers\Controller;
use App\Models\HumanResources\Settings\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;

class PermissionController extends Controller {

	public $entity = "permissions";
	public $sex = "F";
	public $name = "Permissão";
	public $names = "Permissões";
	public $main_folder = 'pages.human_resources.settings.permissions';
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
			'title'       => '',
			'create_option' => 0,
			'subtitle'    => '',
			'noresults'   => '',
			'tab'         => 'data',
			'breadcrumb'  => array(),
		];
		$this->breadcrumb( $route );
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */

	public function index(Request $request) {
		$this->page->response = Permission::get()->map( function ( $s ) {
			return [
				'id'                    => $s->id,
				'name'                  => $s->name,
				'created_at'            => $s->created_at_formatted,
				'created_at_time'       => $s->created_at_time,
			];
		} );

		$this->page->create_option = 0;
		return view('pages.human_resources.settings.permissions.index' )
			->with( 'Page', $this->page );
	}

}
