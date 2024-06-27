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

use App\Http\Controllers\HumanResources\Settings\CepCityController;
use App\Http\Controllers\HumanResources\Settings\CepStateController;
use App\Http\Controllers\HumanResources\Settings\GroupController;
use App\Http\Controllers\HumanResources\Settings\GroupVoterController;
use App\Http\Controllers\HumanResources\VoterController;
use App\Http\Controllers\HumanResources\UserController;
use App\Http\Controllers\HumanResources\Settings\PollingPlaceController;


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
        Route::get( 'profile', [UserController::class, 'profile'] )->name( 'users.my.profile' );
        Route::post( 'change-my-password', [UserController::class, 'updateMyPassword'] )->name( 'users.change.my.password' );
        Route::get( 'removeds', [UserController::class, 'removeds'] )->name( 'users.removeds' );
        Route::get( 'restore/{user}', [UserController::class, 'restore'])->name( 'users.restore' );
        Route::post( 'change-user-password', [UserController::class, 'updateUserPassword'] )->name( 'users.change.password' );
    } );
    Route::resource( 'users', 'UserController' );

    Route::group( [ 'namespace' => 'Settings','prefix' => 'settings' ], function () {
        Route::group( ['prefix' => 'groups'], function () {
            Route::get( 'removeds', [GroupController::class, 'removeds'] )->name( 'groups.removeds' );
            Route::get( 'restore/{group}', [GroupController::class, 'restore'] )->name( 'groups.restore' );
        } );
        Route::resource( 'groups', 'GroupController' );
        Route::get('/voters/{voter}/available-groups', [GroupController::class, 'availableGroups'])->name('voters.availableGroups');
        Route::post('/group-voter/attach', [GroupVoterController::class, 'attach'])->name('voter.group.attach');
        Route::delete('/group-voter/detach', [GroupVoterController::class, 'detach'])->name('voter.group.detach');

        Route::group( ['prefix' => 'ceps' ], function () {
            Route::get( 'states', [CepStateController::class, 'index'] )->name( 'ceps.get.states' );
            Route::get( 'cities', [CepCityController::class, 'index'] )->name( 'ceps.get.cities' );
        } );

        Route::get( 'polling_places', [PollingPlaceController::class, 'index'] )->name( 'polling_places.index' );

    } );

    Route::group( ['prefix' => 'voters'], function () {
        Route::get( 'removeds', [VoterController::class, 'removeds'] )->name( 'voters.removeds' );
        Route::get( 'restore/{group}', [VoterController::class, 'restore'] )->name( 'voters.restore' );
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