<?php

namespace App\Observers\HumanResources;

use App\Models\HumanResources\Voter;
use App\Models\HumanResources\Settings\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class VoterObserver {

	protected $request;
	protected $table = 'voters';

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
	 * @param Voter $voter
	 *
	 * @return void
	 */
	public function creating( Voter $voter )
    {
		//CRIAR UM ADDRESS
        $user = Auth::user()->load('voter');
		$address           = Address::create( $this->request->all() );
		$voter->address_id = $address->id;
        $voter->register_id = $user->id;
        $voter->sponsor_id = $user->voter->id;
	}


	/**
	 * Listen to the Voter updating event.
	 *
	 * @param Voter $voter
	 *
	 * @return void
	 */
	public function saving( Voter $voter )
    {
		if ( $voter->address != null ) {
			$voter->address->update( $this->request->all() );
		}
        $voter->votes_estimate = $voter->votes_estimate ? $voter->votes_estimate : 0;
        /*
         * Se tiver birthday, a years_approximate fica oculto e vice-versa.
            São campos OU-EXCLUSIVO, se um for preenchido, o outro é zerado
         */
        if($voter->birthday != null){
            $voter->years_approximate = null;
        }
        if(!$voter->death){
            $voter->death_date = null;
        }
	}
	/**
	 * Listen to the Provider deleting event.
	 *
	 * @param Voter $voter
	 *
	 * @return void
	 */
	public function deleting( Voter $voter )
    {
		$voter->address->delete();
//        $path = $voter->real_path;
//        File::deleteDirectory($path);
	}

    /**
     * Listen to the Provider restoring event.
     *
     * @param Voter $voter
     *
     * @return void
     */
    public function restoring(Voter $voter)
    {
        // Check if the related address exists and is soft-deleted
        $address = $voter->address()->withTrashed()->first();

        if ($address && $address->trashed()) {
            // Restore the related address
            $address->restore();
        }
    }
}
