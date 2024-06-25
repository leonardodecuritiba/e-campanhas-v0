<?php
/*
|--------------------------------------------------------------------------
| Ajax Routes
|--------------------------------------------------------------------------
|
*/
Route::namespace('Commons')->middleware('auth')->prefix('commons')->group( function () {
//    Route::get( 'state-city', 'CommonsController@getStateCityToSelect' )->name( 'ajax.get.state-city' );
    Route::get( 'conveyors-generalities/{conveyor}', 'CommonsController@getConveyorsGeneralitiesToSelect' )->name( 'ajax.get.conveyors-generalities' );
    Route::get( 'set-active', 'CommonsController@setActive' )->name( 'ajax.set.active' );
    Route::get( 'get-ajax-to-select2', 'CommonsController@ajaxSelect2' )->name('ajax.get-select2');
    Route::get( 'get-entities', 'CommonsController@getEntities' )->name( 'ajax.get.entities' );
	Route::get( 'get-receivers', 'CommonsController@getReceivers' )->name( 'ajax.get.receivers' );
	Route::get( 'get-partners', 'CommonsController@getPartners' )->name( 'ajax.get.partners' );

    Route::get( 'get-moviments/{contract}/filter', 'CommonsController@getMoviments' )->name( 'ajax.get.moviments' );
    Route::get( 'expense_types', 'ExpenseTypeController@index' )->name( 'ajax.commons.expense_types.index' );
    /*
	|--------------------------------------------------------------------------
	| Observations Routes
	|--------------------------------------------------------------------------
	|
	*/
    Route::post( 'observations/store', 'ObservationController@store' )->name( 'ajax.commons.observations.store' );
    Route::delete( 'observations/destroy/{observation}', 'ObservationController@destroy' )->name( 'ajax.commons.observations.destroy' );
    /*
	|--------------------------------------------------------------------------
	| Attachments Routes
	|--------------------------------------------------------------------------
	|
	*/
    Route::delete( 'attachments/destroy/{attachment}', 'AttachmentController@destroy' )->name( 'ajax.commons.attachments.destroy' );
    /*
	|--------------------------------------------------------------------------
	| Departments Routes
	|--------------------------------------------------------------------------
	|
	*/
    Route::get( 'departments', 'DepartmentController@index' )->name( 'ajax.commons.departments.index' );
});

/*
|--------------------------------------------------------------------------
| HumanResources Routes
|--------------------------------------------------------------------------
|
*/
Route::namespace('HumanResources')->middleware('auth')->prefix('human_resources')->group( function () {

    Route::get( 'users', 'UserController@index' )->name( 'ajax.human_resources.users.index' );
    Route::get( 'suppliers', 'SupplierController@index' )->name( 'ajax.human_resources.suppliers.index' );
    Route::get( 'supplier_conveyor', 'SupplierConveyorController@index' )->name( 'ajax.human_resources.supplier_conveyor.index' );

    Route::post( 'read-notification/{id}', 'NotificationController@read' )->name( 'ajax.human_resources.notification.read' );
    Route::post( 'read-all-notification', 'NotificationController@readAll' )->name( 'ajax.human_resources.notification.read-all' );

	Route::namespace('Settings')->prefix('settings')->group( function () {
		Route::post( 'attach/{group_id}', 'EntityGroupController@attach' )->name( 'ajax.human_resources.settings.groups.attach' );
		Route::post( 'dettach/{group_id}/{entity_id}', 'EntityGroupController@dettach' )->name( 'ajax.human_resources.settings.groups.dettach' );
		Route::get( 'groups', 'GroupController@index' )->name( 'ajax.human_resources.settings.groups.index' );
	});
    Route::get( 'suppliers/select2', 'SupplierController@select2' )->name( 'suppliers.select2' );
});

/*
|--------------------------------------------------------------------------
| Moviments Routes
|--------------------------------------------------------------------------
|
*/
Route::group( [ 'prefix' => 'moviments','namespace' => 'Moviments', 'middleware' => 'auth' ], function () {

    Route::group( [ 'prefix' => 'settings','namespace' => 'Settings'], function () {
        Route::post( 'contract_items/update-service-type', 'ContractItemController@updateServiceType' )->name( 'ajax.contract_items.update-service-type' );
        Route::delete( 'contract_items/delete-many', 'ContractItemController@destroyMany' )->name( 'ajax.contract_items.delete-many' );

        Route::group( ['prefix' => 'regions'], function () {
            Route::post( 'attach/{id}', 'CepStateRegionController@attach' )->name( 'ajax.moviments.settings.regions.attach' );
            Route::post( 'dettach/{region_id}/{id}', 'CepStateRegionController@dettach' )->name( 'ajax.moviments.settings.regions.dettach' );
        } );

        Route::get( 'regions', 'RegionController@index' )->name( 'ajax.moviments.settings.regions.index' );
    } );

    Route::group( [ 'prefix' => 'commons','namespace' => 'Commons'], function () {
        Route::get( 'entities', 'EntityController@index' )->name( 'ajax.moviments.commons.entities.index' );
    } );

    Route::post( 'contracts/pre-contracts/inactivate', 'PreContractController@inactivate' )->name( 'ajax.contracts.pre-contracts.inactivate' );
    Route::get( 'conveyors', 'ConveyorController@index' )->name( 'ajax.moviments.conveyors.index' );

} );