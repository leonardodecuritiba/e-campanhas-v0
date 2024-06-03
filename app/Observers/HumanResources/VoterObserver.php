<?php

namespace App\Observers\HumanResources;

use App\Models\HumanResources\Voter;
use App\Models\HumanResources\Settings\Address;
use App\Models\HumanResources\Settings\Contact;
use Illuminate\Http\Request;

class VoterObserver {

	protected $request;
	protected $table = 'voters';

	public function __construct( Request $request ) {
		$this->request = $request;
	}
	/**
	 * Listen to the Provider created event.
	 *
	 * @param Voter $voter
	 *
	 * @return void
	 */
	public function creating( Voter $voter ) {
		//CRIAR UM ADDRESS
		//CRIAR UM CONTACT
		$contact            = Contact::create( $this->request->all() );
		$address            = Address::create( $this->request->all() );
		$voter->contact_id = $contact->id;
		$voter->address_id = $address->id;
	}


	/**
	 * Listen to the Voter updating event.
	 *
	 * @param Voter $voter
	 *
	 * @return void
	 */
	public function saving( Voter $voter ) {
		if ( $voter->address != null ) {
			$voter->address->update( $this->request->all() );
			$voter->contact->update( $this->request->all() );
		}
	}
	/**
	 * Listen to the Provider deleting event.
	 *
	 * @param Voter $voter
	 *
	 * @return void
	 */
	public function deleting( Voter $voter ) {
		$voter->address->delete();
		$voter->contact->delete();
	}
}
