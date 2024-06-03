<?php

namespace App\Http\Controllers\HumanResources;

use App\Http\Controllers\Controller;
use App\Http\Requests\HumanResources\User\UpdatePasswordRequest;
use App\Http\Requests\HumanResources\User\UserRequest;
use App\Models\HumanResources\Settings\Role;
use App\Models\HumanResources\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;
use Zizaco\Entrust\Entrust;

class UserController extends Controller {

    public $entity = "users";
    public $sex = "M";
    public $name = "Usuário";
    public $names = "Usuários";
    public $main_folder = 'pages.human_resources.users';
    public $page = [];

    public function __construct( Route $route ) {
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
            'page_title'  => '',
            'title'       => 'Usuários',
            'subtitle'    => 'Usuários',
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
        $user_id = $this->user->id;
        $this->page->response = User::get()->map( function ( $s ) use ($user_id) {
            return [

                'id'              => $s->id,
                'type_formatted'  => $s->type_formatted,
                'name'            => $s->getShortName(),
                'email'           => $s->getEmail(),
                'created_at'      => $s->created_at_formatted,
                'created_at_time' => $s->created_at_time,

                'its_me'          => $s->itsMe($user_id)
//				'active'          => $s->getActiveFullResponse()
            ];
        } );

        $this->page->create_option = 1;
        return view( 'pages.human_resources.users.index' )
            ->with( 'Page', $this->page );
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function profile() {
        $this->page->create_option = 0;
        return view(  'pages.human_resources.users.master' )
            ->with( 'Page', $this->page )
            ->with( 'Data', $this->user );
    }
    /**
     * Display the specified resource.
     *
     *
     * @return Response
     */
    public function create() {
        $this->page->create_option = 0;
        if($this->user->hasRole('admin','root')){
            $this->page->auxiliar = [
                'roles' => Role::getAlltoSelectList(),
            ];
        }
        return view(  'pages.human_resources.users.master' )
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
        if($this->user->itsMe($id)){
            return Redirect::route('profile.my');
        }
        $user = User::findOrFail( $id );
        if($this->user->hasRole('admin','root')){
            $this->page->create_option = 1;
            $this->page->auxiliar = [
                'roles' => Role::getAlltoSelectList(),
            ];
        }

        return view( 'pages.human_resources.users.master' )
            ->with( 'Page', $this->page )
            ->with( 'Data', $user );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param  $id
     *
     * @return Response
     */
    public function update( UserRequest $request, $id )
    {
        $data = User::findOrFail( $id );
        $data->update( $request->all() );
        return $this->redirect( 'UPDATE', $data );
    }

    /**
     * Store the specified resource in storage.
     *
     * @param UserRequest $request
     *
     * @return Response
     */
    public function store( UserRequest $request )
    {
        $data = User::create( $request->all() );
        $data->attachRole($request->get('role_id'));
        return $this->redirect( 'STORE', $data );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HumanResources\User $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy( User $user ) {
        $message = $this->getMessageFront( 'DELETE', $this->name . ': ' . $user->getShortName() );
        $user->delete();

        return new JsonResponse( [
            'status'  => 1,
            'message' => $message,
        ], 200 );
    }
    /**
     * Show the application dashboard.
     *
     * @param \App\Http\Requests\HumanResources\User\UpdatePasswordRequest $request
     *
     * @return Response
     */
    public function updatePassword( UpdatePasswordRequest $request )
    {
        $this->user->updatePassword( $request->get( 'password' ) );
        $route = route( 'profile.my' );
        return response()->success( trans( 'messages.password_ok' ), NULL, $route );
    }
}
