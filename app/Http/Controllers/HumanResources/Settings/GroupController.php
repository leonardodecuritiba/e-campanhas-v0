<?php

namespace App\Http\Controllers\HumanResources\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commons\Select2QueryRequest;
use App\Http\Requests\HumanResources\Settings\GroupRequest;
use App\Models\HumanResources\Voter;
use App\Services\HumaResources\Settings\GroupService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Route;

class GroupController extends Controller {

    public $entity = "groups";
    public $sex = "M";
    public $name = "Grupo";
    public $names = "Grupos";
    public $main_folder = 'pages.human_resources.settings.groups';
    public $page = [];
    protected $groupService;

    public function __construct( Route $route, GroupService $groupService)
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
        $this->hasPermission('groups.index');
        $this->page->response = $this->groupService->listGroup( $this->user );
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
        $this->hasPermission('groups.create');
        $this->page->create_option = 0;
        return view('pages.human_resources.settings.groups.create' )
            ->with( 'Page', $this->page );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|\Illuminate\View\View|View
     */
    public function edit( int $id )
    {
        $this->hasPermission('groups.edit');
        $group = $this->groupService->findGroup( $id, $this->user );
        $this->page->create_option = 1;
        return view('pages.human_resources.settings.groups.edit' )
            ->with( 'Page', $this->page )
            ->with( 'Group', $group );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function show( int $id )
    {
        $this->hasPermission('groups.show');
        $group = $this->groupService->findGroup( $id, $this->user );
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
        $this->hasPermission('groups.create');
        $data = $this->groupService->createGroup( $request->all() );
        return $this->redirect( 'STORE', $data );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GroupRequest $request
     * @param int $id
     * @return string
     */
    public function update( GroupRequest $request, int $id)
    {
        $this->hasPermission('groups.edit');
        $data = $this->groupService->updateGroup( $id, $request->all(), $this->user );
        return $this->redirect( 'UPDATE', $data );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function destroy( int $id )
    {
        $this->hasPermission('groups.delete');
        $description = $this->groupService->destroyGroup( $id, $this->user );
        $message = $this->getMessageFront( 'DELETE', $this->name . ': ' . $description );
        return new JsonResponse( [
            'status'  => true,
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
        $this->hasPermission('groups.removeds');
        $this->page->response = $this->groupService->listGroupRemoveds( $this->user );
        $this->page->create_option = 1;
        return view( 'pages.human_resources.settings.groups.removeds' )
            ->with( 'Page', $this->page );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return string
     */
    public function restore( int $id )
    {
        $this->hasPermission('groups.restore');
        $group = $this->groupService->restoreGroup( $id, $this->user );
        return $this->redirect( 'RESTORE', $group );
    }

    /**
     * Get available groups for user.
     *
     * @param Select2QueryRequest $request
     * @param Voter $voter
     * @return JsonResponse
     */
    public function availableGroups(Select2QueryRequest $request, Voter $voter)
    {
        $this->hasPermission('groups.index');
        $availableGroups = $this->groupService->getAvailableGroupsForVoter( $voter, $this->user, $request->term );
        return response()->json($availableGroups);
    }
}
