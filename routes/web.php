<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'HomeController@index')->name('index');
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
|
*/
Route::group( [ 'namespace' => 'HumanResources','prefix' => 'human_resources', 'middleware' => 'auth' ], function () {

	Route::resource( 'users', 'UserController' );
	Route::get( 'my-profile', 'UserController@profile' )->name( 'profile.my' );
	Route::post( 'password-change', 'UserController@updatePassword' )->name( 'change.password' );
	Route::get( 'removeds', 'UserController@removeds' )->name( 'users.removeds' );
	Route::get( 'restore/{user}', 'UserController@restore' )->name( 'users.restore' );
	Route::post( 'user-password-change', 'UserController@updateUserPassword' )->name( 'users.change.password' );

	Route::resource( 'notifications', 'NotificationController' );
	Route::resource( 'voters', 'VoterController' );

	Route::group( [ 'namespace' => 'Settings','prefix' => 'settings' ], function () {
		Route::resource( 'groups', 'GroupController' );

        Route::group(['middleware' => ['role:root']], function () {
            Route::get( 'permissions', 'PermissionController@index' )->name( 'permissions.index' );
            Route::resource( 'roles', 'RoleController' );
        });

	} );

} );