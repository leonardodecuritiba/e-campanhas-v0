<?php

namespace App\Http\Controllers\HumanResources\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\HumanResources\Settings\GroupRequest;
use App\Models\HumanResources\Settings\Group;
use App\Services\HumaResources\Settings\GroupService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;

class GroupController extends Controller {

    public $entity = "groups";
    public $sex = "M";
    public $name = "Grupo";
    public $names = "Grupos";
    public $main_folder = 'pages.human_resources.settings.groups';
    public $page = [];
    protected $groupService;

    public function __construct( Route $route, GroupService $groupService) {
        $this->page = (object) [
            'entity'      => $this->entity,
            'main_folder' => $this->main_folder,
            'name'        => $this->name,
            'names'       => $this->names,
            'sex'         => $this->sex,
            'auxiliar'    => array(),
            'response'    => array(),
            'has_menu'    => 1,
            'page_title'  => 'Grupos',
            'title'       => 'Grupos',
            'subtitle'    => 'Grupos',
            'create_option' => 0,
            'noresults'   => '',
            'tab'         => 'data',
            'breadcrumb'  => array(),
        ];
        $this->breadcrumb( $route );
        $this->groupService = $groupService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */

    public function index()
    {
        $this->page->response = Group::get()->map( function ( $s ) {
            return [
                'id'                => $s->id,
                'name'              => $s->description,
                'description'       => $s->description,
                'created_at'        => $s->created_at_formatted,
                'created_at_time'   => $s->created_at_time_formatted,
            ];
        } );
        $this->page->create_option = 1;
        return view('pages.human_resources.settings.groups.index' )
            ->with( 'Page', $this->page );
    }

    /**
     * Create the specified resource.
     *
     *
     * @return Application|Factory|\Illuminate\View\View|View
     */
    public function create()
    {
        $this->page->create_option = 0;
        return view('pages.human_resources.settings.groups.create' )
            ->with( 'Page', $this->page );
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @return Application|Factory|\Illuminate\View\View|View
     */
    public function edit( Group $group )
    {
        $this->page->create_option = 1;
        return view('pages.human_resources.settings.groups.edit' )
            ->with( 'Page', $this->page )
            ->with( 'Data', $group );
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function show( Group $group )
    {
        $this->page->create_option = 1;
        return view('pages.human_resources.settings.groups.show' )
            ->with( 'Page', $this->page )
            ->with( 'Data', $group );
    }

    /**
     * Store the specified resource in storage.
     *
     * @param GroupRequest $request
     *
     * @return string
     */
    public function store( GroupRequest $request )
    {
        $data = $this->groupService->createGroup( $request->all() );
        return $this->redirect( 'STORE', $data );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param GroupRequest $request
     * @param Group $group
     * @return string
     */
    public function update( GroupRequest $request, Group $group)
    {
        $data = $this->groupService->updateGroup( $group, $request->all() );
        return $this->redirect( 'UPDATE', $data );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Group $group
     *
     * @return JsonResponse
     */
    public function destroy( Group $group )
    {
        $message = $this->getMessageFront( 'DELETE', $this->name . ': ' . $group->short_description );
        return new JsonResponse( [
            'status'  => $group->delete(),
            'message' => $message,
        ], 200 );
    }
    /**
     * Display a listing of the removed resource.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function removeds()
    {
        $this->page->response = Group::onlyTrashed()->get()->map( function ( $s ) {
            return [
                'id'              => $s->id,
                'description'     => $s->description,
                'created_at'      => $s->created_at_formatted,
                'created_at_time' => $s->created_at_time_formatted,
                'deleted_at'      => $s->deleted_at_formatted,
                'deleted_at_time' => $s->deleted_at_time_formatted,
            ];
        } );

        $this->page->create_option = 1;
        return view( 'pages.human_resources.settings.groups.removeds' )
            ->with( 'Page', $this->page );
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     *
     * @return RedirectResponse
     */
    public function restore( $id )
    {
        $this->groupService->restoreGroup( $id );
        return Redirect::route('groups.edit', $id);
    }
}
