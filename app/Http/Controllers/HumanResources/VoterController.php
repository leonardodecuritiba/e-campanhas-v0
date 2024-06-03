<?php

namespace App\Http\Controllers\HumanResources;

use App\Filters\VoterFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\HumanResources\VoterRequest;
use App\Models\Commons\CepStates;
use App\Models\HumanResources\Voter;
use App\Models\HumanResources\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VoterController extends Controller {

    public $entity = "voters";
    public $sex = "M";
    public $name = "Eleitor";
    public $names = "Eleitores";
    public $main_folder = 'pages.human_resources.voters';
    public $page = [];
    public $ClientFilter;

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
        $this->VoterFilter = new VoterFilter();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request) {
        $voters = Voter::my();
//        if(Auth::user()->hasRole('seller')){
//            $this->page->response = $this->VoterFilter->map($request, $voters);
//            $this->page->response = $voters->get()->map( function ( $s ) {
//                return [
//                    'id'                    => $s->id,
//                    'fantasy_name_text'     => $s->surname,
//                    'social_reason_text'    => $s->name,
//                    'short_document'        => $s->short_document,
//                    'content'               => $s->short_description,
//                    'name'                  => $s->surname,
//                    'email_contact'         => $s->contact->email_contact,
//                    'phone'                 => $s->contact->phone_formatted,
//                    'created_at'            => $s->created_at_formatted,
//                    'created_at_time'       => $s->created_at_time,
//                ];
//            } );
//        } else {
//            $this->page->response = $this->VoterFilter->map($request, $voters);
//        }

        $this->page->response = $this->VoterFilter->map($request, $voters);
        $this->page->create_option = 1;
        return view('pages.human_resources.voters.index' )
            ->with( 'Page', $this->page );
    }

    /**
     * Create the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function create( ) {
        $this->page->auxiliar = [
            'users' => User::getAlltoSelectList(),
            'states' => CepStates::getAlltoSelectList(),
        ];
        return view('pages.human_resources.voters.master' )
            ->with( 'Page', $this->page );
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     *
     * @return Factory|Application|View
     */
    public function edit( $id ) {
        $this->page->auxiliar = [
            'users' => User::getAlltoSelectList(),
            'states' => CepStates::getAlltoSelectList(),
        ];
        $data = Voter::findOrFail( $id );
        $this->page->create_option = 1;
        return view('pages.human_resources.voters.master' )
            ->with( 'Page', $this->page )
            ->with( 'Data', $data );
    }
    /**
     * Store the specified resource in storage.
     *
     * @param VoterRequest $request
     *
     * @return string
     */
    public function store( VoterRequest $request ) {
        $data = Voter::create( $request->all() );
        return $this->redirect( 'STORE', $data );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param VoterRequest $request
     * @param  $id
     *
     * @return string
     */
    public function update( VoterRequest $request, $id ) {
        $data = Voter::findOrFail( $id );
        $data->update( $request->all() );

        return $this->redirect( 'UPDATE', $data );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Voter $voter
     *
     * @return JsonResponse
     */
    public function destroy( Voter $voter ) {
        $message = $this->getMessageFront( 'DELETE', $this->name . ': ' . $voter->getShortName() );
        return new JsonResponse( [
            'status'  => $voter->delete(),
            'message' => $message,
        ], 200 );
    }
}
