<?php

namespace App\Observers\HumanResources\Settings;

use App\Models\HumanResources\Settings\Address;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;

class AddressObserver {

	protected $request;
	protected $table = 'address';

    /**
     * Listen to the Provider created event.
     *
     * @param Request $request
     *
     */

	public function __construct( Request $request )
    {
		$this->request = $request;
	}
	/**
	 * Listen to the Provider created event.
	 *
	 * @param Address $address
	 *
	 *
	 * @return void
	 */
	public function creating( Address $address )
    {

	}


	/**
	 * Listen to the Group updating event.
	 *
	 * @param Address $address
	 *
	 * @return void
	 */
	public function saving( Address $address )
    {
        if($this->request->has('latitude') && $this->request->has('longitude')) {
            $address->geolocalization = new Point($this->request->latitude, $this->request->longitude);
        }
	}
	/**
	 * Listen to the Provider deleting event.
	 *
	 * @param Address $address
	 *
	 * @return void
	 */
	public function deleting( Address $address )
    {

	}

    /**
     * Listen to the Provider restoring event.
     *
     * @param Address $address
     *
     * @return void
     */
    public function restoring(Address $address)
    {

    }
}
