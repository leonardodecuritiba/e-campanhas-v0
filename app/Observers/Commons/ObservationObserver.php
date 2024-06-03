<?php

namespace App\Observers\Commons;

use App\Models\Commons\Observation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ObservationObserver {
	protected $request;

	public function __construct( Request $request ) {
		$this->request = $request;
	}

	/**
	 * Listen to the Observation creating event.
	 *
	 * @param Observation $observation
	 *
	 * @return void
	 */
	public function creating( Observation $observation )
	{
		$observation->owner_id = Auth::id();
	}
	/**
	 * Listen to the Observation deleting event.
	 *
	 * @param Observation $observation
	 *
	 * @return void
	 */
	public function deleting( Observation $observation )
	{
	}
}