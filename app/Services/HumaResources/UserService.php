<?php
namespace App\Services\HumaResources;

use App\Models\HumanResources\User;
use Illuminate\Support\Collection;

class UserService{

    /**
     * Voter List.
     * User coordinator only can view registrars
     *
     * @param User $user
     * @return Collection
     */
    public function listUser(User $user): Collection
    {
        $query = User::query();
        if($user->hasRole('coordinator|registrar'))
        {
            $query->role('registrar');
        }
        $user_id = $user->id;
        return $query->get()->map( function ( $s ) use ($user_id) {
            return [
                'id'                    => $s->id,
                'role_name_formatted'   => $s->role_name_formatted,
                'name'            => $s->name,
                'email'           => $s->email,
                'created_at'      => $s->created_at_formatted,
                'created_at_time' => $s->created_at_time_formatted,
                'its_me'          => $s->itsMe($user_id)
            ];
        } );
    }

    /**
     * User List.
     * User registrar only can view self voters
     *
     * @param int $id
     * @param User $user
     * @return User
     */
    public function findUser( int $id, User $user ): User
    {
        $query = User::with('roles');
        if($user->hasRole('coordinator|registrar'))
        {
            $query->role('registrar');
        }
        return $query->findOrFail( $id );
    }

    public function createUser(array $data): User
    {
        $user = User::create($data );
        $user->assignRole($data['role_id']);
        return $user;
    }

    public function updateUser(int $id, User $user, array $data): User
    {
        $user = $this->findUser( $id, $user );
        $user->update($data);
        return $user;
    }

    public function destroyUser(int $id, User $user): string
    {
        $user = $this->findUser( $id, $user );
        $description = $user->name;
        $user->delete();
        return $description;
    }


    /**
     * Removeds Voters List.
     * User registrar only can view self voters
     *
     * @param User $user
     * @return Collection
     */
    public function listUserRemoveds(User $user): Collection
    {
        $query = User::onlyTrashed();
        if($user->hasRole('coordinator|registrar'))
        {
            $query->role('registrar');
        }
        return $query->get()->map( function ( $s ) {
            return [
                'id'              => $s->id,
                'role_name'       => $s->role_name_formatted,
                'name'            => $s->short_name,
                'email'           => $s->email,
                'created_at'      => $s->created_at_formatted,
                'created_at_time' => $s->created_at_time_formatted,
                'deleted_at'      => $s->deleted_at_formatted,
                'deleted_at_time' => $s->deleted_at_time_formatted,
            ];
        } );
    }

    public function restoreUser( int $id, User $user): User
    {
        $query = User::withTrashed();
        if($user->hasRole('coordinator|registrar'))
        {
            $query->role('registrar');
        }
        $user_to_restore = $query->findOrFail( $id );
        $user_to_restore->restore();
        return $user_to_restore;
    }

    public function updateUserPassword(User $user, $password): User
    {
        $user->updatePassword( $password );
        return $user;
    }
}