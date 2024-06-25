<?php

namespace App\Observers\HumanResources\Settings;

use App\Models\HumanResources\Settings\GroupVoter;
use Illuminate\Http\Request;

class GroupVoterObserver {

	protected $request;
	protected $table = 'group_voter';

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
	 * @param GroupVoter $group_voter
	 *
	 *
	 * @return void
	 */
	public function creating( GroupVoter $group_voter )
    {

	}


	/**
	 * Listen to the GroupVoter updating event.
	 *
	 * @param GroupVoter $group_voter
	 *
	 * @return void
	 */
	public function saving( GroupVoter $group_voter )
    {

	}
	/**
	 * Listen to the Provider deleting event.
	 *
	 * @param GroupVoter $group_voter
	 *
	 * @return void
	 */
	public function deleting( GroupVoter $group_voter )
    {

	}

    /**
     * Listen to the Provider restoring event.
     *
     * @param GroupVoter $group_voter
     *
     * @return void
     */
    public function restoring(GroupVoter $group_voter)
    {

    }
}
