<?php

namespace App\Http\Controllers\HumanResources;

use App\Http\Controllers\Controller;
use App\Http\Requests\HumanResources\VoterRequest;
use App\Models\Commons\CepStates;
use App\Models\HumanResources\Voter;
use App\Services\HumaResources\VoterService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class VoterController extends Controller {

    public $entity = "voters";
    public $sex = "M";
    public $name = "Eleitor";
    public $names = "Eleitores";
    public $main_folder = 'pages.human_resources.voters';
    public $page = [];
    public $voterService;

    public function __construct( Route $route, VoterService $voterService ) {
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

    public function index() {
        $this->page->response = Voter::get()->map( function ( $s ) {
            return [
                'id'                => $s->id,
                'name'              => $s->name,
                'cpf_formatted'     => $s->cpf_formatted,
                'email'             => $s->email,
                'whatsapp_formatted'=> $s->whatsapp_formatted,
                'created_at'        => $s->created_at_formatted,
                'created_at_time'   => $s->created_at_time_formatted,
            ];
        } );
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
        $this->page->auxiliar = [
//            'users' => User::getAlltoSelectList(),
            'states' => CepStates::getAlltoSelectList(),
        ];
        $this->page->create_option = 0;
        return view('pages.human_resources.voters.create' )
            ->with( 'Page', $this->page );
    }

    /**
     * Display the specified resource.
     *
     * @param Voter $voter
     * @return Factory|Application|View
     */
    public function edit( Voter $voter)
    {
//        return $voter->birthday_formatted;
//        $this->page->auxiliar = [
//            'users' => User::getAlltoSelectList(),
//            'states' => CepStates::getAlltoSelectList(),
//        ];
        $this->page->create_option = 1;
        return view('pages.human_resources.voters.edit' )
            ->with( 'Page', $this->page )
            ->with( 'Data', $voter );
    }

    /**
     * Display the specified resource.
     *
     * @param Voter $voter
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function show( Voter $voter )
    {
        $this->page->create_option = 1;
        return view('pages.human_resources.voters.show' )
            ->with( 'Page', $this->page )
            ->with( 'Data', $voter );
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
        $data = $this->voterService->createVoter( $request->all() );
        return $this->redirect( 'STORE', $data );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param VoterRequest $request
     * @param Voter $voter
     * @return string
     */
    public function update( VoterRequest $request, Voter $voter)
    {
        $data = $this->voterService->updateVoter( $voter, $request->all() );
        return $this->redirect( 'UPDATE', $data );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Voter $voter
     *
     * @return JsonResponse
     */
    public function destroy( Voter $voter )
    {
        $message = $this->getMessageFront( 'DELETE', $this->name . ': ' . $voter->description );
        return new JsonResponse( [
            'status'  => $voter->delete(),
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
        $this->page->response = Voter::onlyTrashed()->get()->map( function ( $s ) {
            return [
                'id'              => $s->id,
                'name'            => $s->name,
                'cpf_formatted'   => $s->cpf_formatted,
                'email'           => $s->email,
                'whatsapp_formatted'=> $s->whatsapp_formatted,
                'created_at'      => $s->created_at_formatted,
                'created_at_time' => $s->created_at_time_formatted,
                'deleted_at'      => $s->deleted_at_formatted,
                'deleted_at_time' => $s->deleted_at_time_formatted,
            ];
        } );

        $this->page->create_option = 1;
        return view( 'pages.human_resources.voters.removeds' )
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
        $this->voterService->restoreVoter( $id );
        return Redirect::route('voters.edit', $id);
    }
}
