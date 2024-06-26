<?php

namespace App\Http\Controllers\HumanResources;

use App\Http\Controllers\Controller;
use App\Http\Requests\HumanResources\VoterRequest;
use App\Services\HumaResources\VoterService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Route;
use Illuminate\View\View;

class VoterController extends Controller {

    public $entity = "voters";
    public $sex = "M";
    public $name = "Eleitor";
    public $names = "Eleitores";
    public $main_folder = 'pages.human_resources.voters';
    public $page = [];
    public $voterService;

    public function __construct( Route $route, VoterService $voterService )
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
        $this->voterService = $voterService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */

    public function index()
    {
        $this->hasPermission('voters.index');
        $this->page->response = $this->voterService->listVoter( $this->user );
        $this->page->create_option = 1;
        return view('pages.human_resources.voters.index' )
            ->with( 'Page', $this->page );
        /*
        if(Auth::user()->hasRole('seller')){
            $this->page->response = $this->VoterFilter->map($request, $voters);
            $this->page->response = $voters->get()->map( function ( $s ) {
                return [
                    'id'                    => $s->id,
                    'fantasy_name_text'     => $s->surname,
                    'social_reason_text'    => $s->name,
                    'short_document'        => $s->short_document,
                    'content'               => $s->short_description,
                    'name'                  => $s->surname,
                    'email_contact'         => $s->contact->email_contact,
                    'phone'                 => $s->contact->phone_formatted,
                    'created_at'            => $s->created_at_formatted,
                    'created_at_time'       => $s->created_at_time,
                ];
            } );
        } else {
            $this->page->response = $this->VoterFilter->map($request, $voters);
        }
        $this->page->response = $this->VoterFilter->map($request, $voters);
        */
    }

    /**
     * Create the specified resource.
     *
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $this->hasPermission('voters.create');
        $this->page->create_option = 0;
        return view('pages.human_resources.voters.create' )
            ->with( 'Page', $this->page );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|Application|View
     */
    public function edit( int $id )
    {
        $this->hasPermission('voters.edit');
        $voter = $this->voterService->findVoter( $id, $this->user );
        $this->page->create_option = 1;
        return view('pages.human_resources.voters.edit' )
            ->with( 'Page', $this->page )
            ->with( 'Voter', $voter );
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
        $this->hasPermission('voters.show');
        $voter = $this->voterService->findVoter( $id, $this->user );
        $this->page->create_option = 1;
        return view('pages.human_resources.voters.show' )
            ->with( 'Page', $this->page )
            ->with( 'Voter', $voter );
    }

    /**
     * Store the specified resource in storage.
     *
     * @param VoterRequest $request
     *
     * @return string
     */
    public function store( VoterRequest $request )
    {
        $this->hasPermission('voters.create');
        $data = $this->voterService->createVoter( $request->all(), $this->user );
        return $this->redirect( 'STORE', $data );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VoterRequest $request
     * @param int $id
     * @return string
     */
    public function update( VoterRequest $request, int $id)
    {
        $this->hasPermission('voters.edit');
        $data = $this->voterService->updateVoter( $id, $request->all(), $this->user );
        return $this->redirect( 'UPDATE', $data );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy( int $id )
    {
        $this->hasPermission('voters.delete');
        $description = $this->voterService->destroyVoter( $id, $this->user );
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
        $this->hasPermission('voters.removeds');
        $this->page->response = $this->voterService->listVoterRemoveds( $this->user );
        $this->page->create_option = 1;
        return view( 'pages.human_resources.voters.removeds' )
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
        $this->hasPermission('voters.restore');
        $voter = $this->voterService->restoreVoter( $id, $this->user );
        return $this->redirect( 'RESTORE', $voter, route( 'voters.removeds' ) );
    }
}
