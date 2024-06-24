<?php

namespace App\Http\Controllers\HumanResources\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\HumanResources\Settings\RoleRequest;
use App\Models\HumanResources\Settings\Permission;
use App\Models\HumanResources\Settings\Role;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class RoleController extends Controller {

	public $entity = "roles";
	public $sex = "M";
	public $name = "Role";
	public $names = "Role";
	public $main_folder = 'pages.human_resources.settings.roles';
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
	 * @return Application|Factory|View
     */
	public function index(Request $request)
    {
		$this->page->response = Role::with('permissions')->where('name','<>', 'root')->get()->map( function ( $s ) {
			return [
				'id'                    => $s->id,
                'name'                  => $s->name,
                'short_description'     => $s->name,
                'permissions'           => $s->permissions->pluck('name'),
				'created_at'            => $s->created_at_formatted,
				'created_at_time'       => $s->created_at_time,
			];
		} );
		return view('pages.human_resources.settings.roles.index' )
			->with( 'Page', $this->page );
	}

    /**
     * Create the specified resource.
     *
     *
     * @return void
     */
    public function create( ): void
    {
        abort(500, 'Not implemented');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  $id
	 *
     * @return Application|Factory|View
	 */
	public function edit( $id )
    {
		$role = Role::with('permissions')->findOrFail( $id );
        $this->page->auxiliar = [
            'permissions' => Permission::getAlltoSelectList(),
        ];
		return view('pages.human_resources.settings.roles.edit' )
			->with( 'Page', $this->page )
			->with( 'Role', $role );
	}


    /**
     * Store the specified resource in storage.
     *
     * @param RoleRequest $request
     *
     * @return void
     */
    public function store( RoleRequest $request ):void
    {
        abort(500, 'Not implemented');
//        $data = Role::create( $request->only("name") );
//        $permissions = $request->get( 'permissions');
//        $data->syncPermissions($permissions);
//        return $this->redirect( 'STORE', $data );
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param RoleRequest $request
	 * @param  $id
	 *
	 * @return string
     */
	public function update( RoleRequest $request, $id )
    {
		$data = Role::findOrFail( $id );
//        $data->update($request->all());
		$permissions = $request->get( 'permissions');
        $data->syncPermissions($permissions);
		return $this->redirect( 'UPDATE', $data );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Role $role
	 *
	 * @return JsonResponse
	 * @throws Exception
	 */
	public function destroy( Role $role )
    {
        abort(500, 'Not implemented');
//		$message = $this->getMessageFront( 'DELETE', $this->name . ': ' . $role->getShortName() );
//		return new JsonResponse( [
//			'status'  => $role->delete(),
//			'message' => $message,
//		], 200 );
	}
}
