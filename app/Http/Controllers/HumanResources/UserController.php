<?php

namespace App\Http\Controllers\HumanResources;

use App\Http\Controllers\Controller;
use App\Http\Requests\HumanResources\User\UpdateMyPasswordRequest;
use App\Http\Requests\HumanResources\User\UpdatePasswordRequest;
use App\Http\Requests\HumanResources\User\UserRequest;
use App\Models\HumanResources\Settings\Role;
use App\Models\HumanResources\User;
use App\Services\HumaResources\UserService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller {

    public $entity = "users";
    public $sex = "M";
    public $name = "Usuário";
    public $names = "Usuários";
    public $main_folder = 'pages.human_resources.users';
    public $page = [];
    protected $userService;

    public function __construct( Route $route, UserService $userService ) {
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
            'page_title'  => 'Usuários',
            'title'       => 'Usuários',
            'subtitle'    => 'Usuários',
            'noresults'   => '',
            'tab'         => 'data',
            'breadcrumb'  => array(),
        ];
        $this->breadcrumb( $route );
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */

    public function index()
    {
        $user_id = $this->user->id;
        $this->page->response = User::get()->map( function ( $s ) use ($user_id) {
            return [
                'id'              => $s->id,
                'role_name'       => $s->role_name_formatted,
                'name'            => $s->name,
                'email'           => $s->email,
                'created_at'      => $s->created_at_formatted,
                'created_at_time' => $s->created_at_time_formatted,
                'its_me'          => $s->itsMe($user_id)
            ];
        } );

        $this->page->create_option = 1;
        return view( 'pages.human_resources.users.index' )
            ->with( 'Page', $this->page );
    }

    /**
     * Display the specified resource.
     *
     *
     * @return Application|Factory|\Illuminate\View\View|View
     */
    public function create()
    {
        $this->page->create_option = 0;
        if($this->user->hasRole('admin') || $this->user->hasRole('root')){
            $this->page->auxiliar = [
                'roles' => Role::getAlltoSelectList(),
            ];
        }
        return view(  'pages.human_resources.users.create' )
            ->with( 'Page', $this->page );
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|Factory|RedirectResponse|\Illuminate\View\View|View
     */
    public function edit( User $user )
    {
        if($this->user->itsMe($user->id)){
            return Redirect::route('users.my.profile');
        }
        $this->page->create_option = 1;
        $this->page->auxiliar = [
            'roles' => Role::getAlltoSelectList(),
        ];

        return view( 'pages.human_resources.users.edit' )
            ->with( 'Page', $this->page )
            ->with( 'Data', $user );
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|Factory|RedirectResponse|\Illuminate\View\View|View
     */
    public function show( User $user )
    {
        if($this->user->itsMe($user->id)){
            return Redirect::route('users.my.profile');
        }
        $this->page->create_option = 1;
        return view( 'pages.human_resources.users.show' )
            ->with( 'Page', $this->page )
            ->with( 'Data', $user );
    }

    /**
     * Store the specified resource in storage.
     *
     * @param UserRequest $request
     *
     * @return string
     */
    public function store( UserRequest $request )
    {
        $data = $this->userService->createUser( $request->all() );
        return $this->redirect( 'STORE', $data );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return string
     */
    public function update( UserRequest $request, User $user)
    {
        $data = $this->userService->updateUser( $user, $request->all() );
        return $this->redirect( 'UPDATE', $data );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return JsonResponse
     */
    public function destroy( User $user )
    {
        $message = $this->getMessageFront( 'DELETE', $this->name . ': ' . $user->short_description );
        $user->delete();
        return new JsonResponse( [
            'status'  => 1,
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
        $this->page->response = User::onlyTrashed()->get()->map( function ( $s ) {
            return [
                'id'              => $s->id,
                'role_name'       => $s->role_name_formatted,
                'name'            => $s->short_name,
                'email'           => $s->email,
                'created_at'      => $s->created_at_formatted,
                'created_at_time' => $s->created_at_time_formatted,
                'deleted_at'      => $s->deleted_at_formatted,
                'deleted_at_time' => $s->deleted_at_time_formatted,
            ];
        } );

        $this->page->create_option = 1;
        return view( 'pages.human_resources.users.removeds' )
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
        $this->userService->restoreUser( $id );
        return Redirect::route('users.edit', $id);
    }

    /**
     * Show the application dashboard.
     *
     * @return Application|Factory|\Illuminate\View\View|View
     */
    public function profile()
    {
        $this->page->create_option = 0;
        return view(  'pages.human_resources.users.edit' )
            ->with( 'Page', $this->page )
            ->with( 'Data', $this->user );
    }

    /**
     * Show the application dashboard.
     *
     * @param UpdateMyPasswordRequest $request
     *
     * @return Response
     */
    public function updateMyPassword( UpdateMyPasswordRequest $request )
    {
        $this->userService->updateUserPassword( $this->user, $request->get( 'password' ) );
        $route = route( 'users.my.profile' );
        return response()->success( trans( 'messages.password_ok' ), NULL, $route );
    }
    /**
     * Show the application dashboard.
     *
     * @param UpdatePasswordRequest $request
     *
     * @return Response
     */
    public function updateUserPassword( UpdatePasswordRequest $request )
    {
        $user = User::findOrFail( $request->get( 'id' ) );
        $data = $this->userService->updateUserPassword( $user, $request->get( 'user_password' ) );
        $route = route( 'users.edit', $data->id );
        return response()->success( trans( 'messages.password_ok' ), NULL, $route );
    }
}
