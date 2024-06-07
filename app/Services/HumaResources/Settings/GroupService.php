<?php
namespace App\Services\HumaResources\Settings;

use App\Models\HumanResources\Settings\Group;

class GroupService{

    public function createGroup(array $data): Group
    {
        $group = Group::create($data );
        return $group;
    }

    public function updateGroup(Group $group, array $data): Group
    {
        $group->update($data);
        return $group;
    }

    public function restoreGroup( int $id): Group
    {
        $group = Group::withTrashed()->findOrFail( $id );
        $group->restore();
        return $group;
    }
    
    
    /*

    public function findUser( int $id): Group
    {
        return Group::findOrFail( $id );
    }

    public function updateUserPassword(Group $group, $password): Group
    {
        $group->updatePassword( $password );
        return $group;
    }
    */
}