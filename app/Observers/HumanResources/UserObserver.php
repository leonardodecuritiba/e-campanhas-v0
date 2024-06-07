<?php

namespace App\Observers\HumanResources;

use App\Models\HumanResources\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserObserver {

	protected $request;
	protected $table = 'users';

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
	 * @param User $user
	 *
	 * @return void
	 */
	public function creating( User $user ): void
    {
        if($this->request->has('password')){
            $password = $this->request->get('password');
        } else {
            $password = $user->password;
        }
        $user->password = Hash::make($password);
    }


	/**
	 * Listen to the Client updating event.
	 *
	 * @param User $user
	 *
	 * @return void
	 */
	public function saving( User $user ): void
    {
		if(isset($user->id) && $this->request->has('role_id')){
			$role_id = $this->request->get('role_id');
			if($role_id != $user->getRoleId()){
                $user->syncRoles([$role_id]);
			}
		}
	}
	/**
	 * Listen to the Provider deleting event.
	 *
	 * @param User $user
	 *
	 * @return void
	 */
	public function deleting( User $user ): void
    {
//        $user->detachRoles();
	}
}
