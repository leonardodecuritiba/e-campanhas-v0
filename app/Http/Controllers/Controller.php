<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $user;
    public $page = NULL;

    public function __construct(  ) {
        $this->middleware( 'auth' );
        $this->middleware( function ( $request, $next ) {
            $this->user = Auth::user();
            return $next( $request );
        } );

        $this->page = (object) [
            'entity'      => isset($this->entity) ? $this->entity : NULL,
            'main_folder' => isset($this->main_folder) ? $this->main_folder : NULL,
            'name'        => isset($this->name) ? $this->name : NULL,
            'names'       => isset($this->names) ? $this->names : NULL,
            'sex'         => isset($this->sex) ? $this->sex : NULL,
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
    }
	/**
	 * Define error messages.
	 *
	 * @param $errors
	 *
	 * @return string
	 *
	 */
	public function error( $errors ) {
		return response()->error( $errors , $status = 200 );
	}
	//function ( $errors, $status = 400 )
	/**
	 * Define getMessageFront.
	 *
	 * @param $data
	 *
	 * @return string
	 *
	 */
	public function returning( $data ) {
		return response()->success( trans( 'messages.success' ), $data, [] );
	}

    /**
     * Define getMessageFront.
     *
     * @param string $type
     * @param $data
     * @param string|null $route
     *
     * @return string
     */
    public function redirect( string $type, $data, string $route = NULL ) {
        return response()->success( $this->getMessageFront( $type ), $data, ($route == NULL) ? route( $this->entity . '.index', $data->id ) : $route);
    }

    /**
     * Define getMessageFront.
     *
     * @param $type
     *
     * @return string
     *
     */
    public function getMessageFront( $type, $name = null ) {
        if ( $type == 'DELETE' ) {
            return trans( 'messages.crud.' . $this->sex . '.' . strtoupper( $type ) . '.SUCCESS', [ 'name' => $name ] );
        }

        return trans( 'messages.crud.' . $this->sex . '.' . strtoupper( $type ) . '.SUCCESS', [ 'name' => $this->name ] );
    }

    /**
     * Define breadcrumb.
     *
     * @param  Route $route
     *
     */
    public function breadcrumb( $route ) {
        $action                 = $route->getActionMethod();
        $this->page->title = trans( 'pages.view.' . strtoupper( $action ), [ 'name' => $this->names ] );
        $this->page->subtitle = trans( 'pages.view.' . strtoupper( $action ), [ 'name' => $this->names ] );
        $this->page->noresults  = trans( 'pages.view.NORESULTS.' . $this->sex, [ 'name' => $this->name ] );

        switch ( $action ) {
//			case 'index':
//				$this->PageResponse->breadcrumb = [
//					['route'=>route('index'),'text'=>'Home'],
//					['route'=>NULL,'text'=> $this->names]
//				];
//				break;
            case 'create':
                $this->page->breadcrumb = [
                    [ 'route' => route( 'index' ), 'text' => 'Home', 'icon' => 'home' ],
                    [ 'route' => route( $this->entity . '.index' ), 'text' => $this->names , 'icon' => 'book'],
                    [ 'route' => null, 'text' => trans( 'pages.view.CREATE', [ 'name' => $this->name ] ), 'icon' => 'plus-circle' ],
                ];
                break;
            case 'edit':
                $this->page->breadcrumb = [
                    [ 'route' => route( 'index' ), 'text' => 'Home', 'icon' => 'home' ],
                    [ 'route' => route( $this->entity . '.index' ), 'text' => $this->names, 'icon' => 'book' ],
                    [ 'route' => null, 'text' => trans( 'pages.view.EDIT', [ 'name' => $this->name ] ), 'icon' => 'pencil' ],
                ];
                break;
            default:
                $this->page->breadcrumb = [
                    [ 'route' => route( 'index' ), 'text' => 'Home', 'icon' => 'home' ],
                    [ 'route' => null, 'text' => $this->names, 'icon' => 'book' ]
                ];
                break;
        }
    }

    /**
     * Checkpermission.
     *
     * @param string $input
     */
    public function hasPermission( string $input ):void
    {
        if (!$this->user->can($input))
        {
            $permissions = is_array($input)
                ? $input
                : explode('|', $input);
            throw UnauthorizedException::forPermissions($permissions);
        }

//        $this->middleware(['role:super-admin','permission:publish articles|edit articles']);
    }


}
