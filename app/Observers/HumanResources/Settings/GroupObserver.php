<?php

namespace App\Observers\HumanResources\Settings;

use App\Models\HumanResources\Settings\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupObserver {

	protected $request;
	protected $table = 'groups';

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
	 * @param Group $group
	 *
	 *
	 * @return void
	 */
	public function creating( Group $group )
    {
        $user = Auth::user();
        $group->register_id = $user->id;
	}


	/**
	 * Listen to the Group updating event.
	 *
	 * @param Group $group
	 *
	 * @return void
	 */
	public function saving( Group $group )
    {

	}
	/**
	 * Listen to the Provider deleting event.
	 *
	 * @param Group $group
	 *
	 * @return void
	 */
	public function deleting( Group $group )
    {

	}

    /**
     * Listen to the Provider restoring event.
     *
     * @param Group $group
     *
     * @return void
     */
    public function restoring(Group $group)
    {

    }
}
