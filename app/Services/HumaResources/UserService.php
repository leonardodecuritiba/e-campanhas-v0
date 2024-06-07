<?php
namespace App\Services\HumaResources;

use App\Models\HumanResources\User;

class UserService{

    public function createUser(array $data): User
    {
        $user = User::create($data );
        $user->assignRole($data['role_id']);
        return $user;
    }

    public function updateUser(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function restoreUser( int $id): User
    {
        $user = User::withTrashed()->findOrFail( $id );
        $user->restore();
        $user->assignRole('root'); //operacional
        return $user;
    }

    public function updateUserPassword(User $user, $password): User
    {
        $user->updatePassword( $password );
        return $user;
    }
}