<?php

namespace App\Http\Controllers\HumanResources\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\HumanResources\Settings\GroupRequest;
use App\Models\HumanResources\Settings\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;

class GroupController extends Controller {

    public $entity = "groups";
    public $sex = "M";
    public $name = "Grupo";
    public $names = "Grupos";
    public $main_folder = 'pages.human_resources.settings.groups';
    public $page = [];

    public function __construct( Route $route ) {
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
     * @return Response
     */

    public function index() {
        $data = Group::get()->map( function ( $s ) {
            return [
                'id'                => $s->id,
                'name'              => $s->getName(),
                'content'           => $s->getContent(),
                'created_at'        => $s->created_at_formatted,
                'created_at_time'   => $s->created_at_time,
                'active'            => $s->getActiveFullResponse()
            ];
        } );

        $this->page->response = $data;
        $this->page->create_option = 1;
        return view('pages.human_resources.settings.groups.index' )
            ->with( 'Page', $this->page );
    }

    /**
     * Create the specified resource.
     *
     *
     * @return Response
     */
    public function create( ) {
        return view('pages.human_resources.settings.groups.master' )
            ->with( 'Page', $this->page );
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     *
     * @return Response
     */
    public function edit( $id ) {
        $data = Group::findOrFail( $id );
        $this->page->create_option = 1;
        return view('pages.human_resources.settings.groups.master' )
            ->with( 'Page', $this->page )
            ->with( 'Data', $data );
    }
    /**
     * Store the specified resource in storage.
     *
     * @param GroupRequest $request
     *
     * @return Response
     */
    public function store( GroupRequest $request ) {
        $data = Group::create( $request->all() );
        return $this->redirect( 'STORE', $data );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  GroupRequest $request
     * @param  $id
     *
     * @return Response
     */
    public function update( GroupRequest $request, $id ) {
        $data = Group::findOrFail( $id );
        $data->update( $request->all() );
        return $this->redirect( 'UPDATE', $data );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Group $group
     *
     * @return JsonResponse
     */
    public function destroy( Group $group ) {
        $message = $this->getMessageFront( 'DELETE', $this->name . ': ' . $group->getShortName() );
        return new JsonResponse( [
            'status'  => $group->delete(),
            'message' => $message,
        ], 200 );
    }
}
