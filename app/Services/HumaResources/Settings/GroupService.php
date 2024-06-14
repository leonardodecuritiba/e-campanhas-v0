<?php
namespace App\Services\HumaResources\Settings;

use App\Models\HumanResources\Settings\Group;
use App\Models\HumanResources\Voter;
use Illuminate\Database\Eloquent\Collection;

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

    public function getAvailableGroupsForVoter( Voter $voter, string $term ): Collection
    {
        // Obtém os IDs dos grupos já associados ao eleitor
        $associatedGroupIds = $voter->groups()->pluck('groups.id');
        // Obtém os grupos disponíveis
        return Group::whereNotIn('id', $associatedGroupIds)->where('description','like','%'.$term.'%')->get(['id', 'description']);
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