<?php

namespace App\Observers\HumanResources;

use App\Models\HumanResources\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserObserver {

	protected $request;
	protected $table = 'users';

	public function __construct( Request $request ) {
		$this->request = $request;
	}
	/**
	 * Listen to the Provider created event.
	 *
	 * @param User $user
	 *
	 * @return void
	 */
	public function creating( User $user ) {
		$user->password = Hash::make($this->request->get('password'));
	}


	/**
	 * Listen to the Client updating event.
	 *
	 * @param User $user
	 *
	 * @return void
	 */
	public function saving( User $user ) {
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
	public function deleting( User $user ) {
        $user->owner_expenses->each(function($p){
            $p->delete();
        });
        $user->approver_expenses->each(function($p){
            $p->delete();
        });
        $user->observations->each(function($p){
            $p->delete();
        });
	}
}
