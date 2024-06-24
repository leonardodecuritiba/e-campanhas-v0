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

    public function __construct( Route $route, UserService $userService )
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
        $this->hasPermission('users.index');
        $this->page->response = $this->userService->listUser( $this->user );
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
        $this->hasPermission('users.create');
        $this->page->create_option = 0;
        $roles = Role::query();
        if($this->user->hasRole('coordinator|registrar'))
        {
            $roles->where('name', 'registrar');
        } elseif($this->user->hasRole('admin'))
        {
            $roles->where('name', '<>', 'root');
        }
        $this->page->auxiliar['roles'] = $roles->get()->map( function ( $s ) {
            return [
                'id'          => $s->id,
                'description' => $s->name
            ];
        } )->pluck( 'description', 'id' );

        return view(  'pages.human_resources.users.create' )
            ->with( 'Page', $this->page );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|RedirectResponse|\Illuminate\View\View|View
     */
    public function edit( int $id )
    {
        $this->hasPermission('users.edit');
        if($this->user->itsMe( $id )){
            return Redirect::route('users.my.profile');
        }
        $user = $this->userService->findUser( $id, $this->user );
        $this->page->create_option = 1;
        $roles = Role::query();
        if($this->user->hasRole('coordinator|registrar'))
        {
            $roles->where('name', 'registrar');
        } elseif($this->user->hasRole('admin'))
        {
            $roles->where('name', '<>', 'root');
        }
        $this->page->auxiliar['roles'] = $roles->get()->map( function ( $s ) {
            return [
                'id'          => $s->id,
                'description' => $s->name
            ];
        } )->pluck( 'description', 'id' );
        return view( 'pages.human_resources.users.edit' )
            ->with( 'Page', $this->page )
            ->with( 'User', $user );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|RedirectResponse|\Illuminate\View\View|View
     */
    public function show( int $id )
    {
        $this->hasPermission('users.show');
        if($this->user->itsMe( $id )){
            return Redirect::route('users.my.profile');
        }
        $user = $this->userService->findUser( $id, $this->user );
        $this->page->create_option = 1;
        return view( 'pages.human_resources.users.show' )
            ->with( 'Page', $this->page )
            ->with( 'User', $user );
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
        $this->hasPermission('users.create');
        $data = $this->userService->createUser( $request->all() );
        return $this->redirect( 'STORE', $data );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param int $id
     * @return string
     */
    public function update( UserRequest $request, int $id)
    {
        $this->hasPermission('users.edit');
        $data = $this->userService->updateUser( $id, $this->user, $request->all() );
        return $this->redirect( 'UPDATE', $data );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return JsonResponse|RedirectResponse
     */
    public function destroy( int $id )
    {
        $this->hasPermission('users.delete');
        if($this->user->itsMe( $id )){
            return Redirect::route('users.my.profile');
        }
        $description = $this->userService->destroyUser( $id, $this->user );
        $message = $this->getMessageFront( 'DELETE', $this->name . ': ' . $description );
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
        $this->hasPermission('users.removeds');
        $this->page->response = $this->userService->listUserRemoveds( $this->user );
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
        $this->hasPermission('users.restore');
        $this->userService->restoreUser( $id, $this->user );
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
            ->with( 'User', $this->user );
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
