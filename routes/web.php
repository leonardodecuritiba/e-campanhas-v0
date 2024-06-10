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

    Route::group( ['prefix' => 'users'], function () {
        Route::get( 'profile', 'UserController@profile' )->name( 'users.my.profile' );
        Route::post( 'change-my-password', 'UserController@updateMyPassword' )->name( 'users.change.my.password' );
        Route::get( 'removeds', 'UserController@removeds' )->name( 'users.removeds' );
        Route::get( 'restore/{user}', 'UserController@restore' )->name( 'users.restore' );
        Route::post( 'change-user-password', 'UserController@updateUserPassword' )->name( 'users.change.password' );
    } );
    Route::resource( 'users', 'UserController' );

    Route::group( [ 'namespace' => 'Settings','prefix' => 'settings' ], function () {
        Route::group( ['prefix' => 'groups'], function () {
            Route::get( 'removeds', 'GroupController@removeds' )->name( 'groups.removeds' );
            Route::get( 'restore/{group}', 'GroupController@restore' )->name( 'groups.restore' );
        } );
        Route::resource( 'groups', 'GroupController' );
    } );

    Route::group( ['prefix' => 'voters'], function () {
        Route::get( 'removeds', 'VoterController@removeds' )->name( 'voters.removeds' );
        Route::get( 'restore/{group}', 'VoterController@restore' )->name( 'voters.restore' );
    } );
    Route::resource( 'voters', 'VoterController' );



	Route::resource( 'notifications', 'NotificationController' );

	Route::group( [ 'namespace' => 'Settings','prefix' => 'settings' ], function () {

        Route::group(['middleware' => ['role:root']], function () {
            Route::get( 'permissions', 'PermissionController@index' )->name( 'permissions.index' );
            Route::resource( 'roles', 'RoleController' );
        });

	} );

} );