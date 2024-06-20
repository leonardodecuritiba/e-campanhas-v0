<?php
namespace App\Services\HumaResources\Settings;

use App\Models\HumanResources\Settings\Group;
use App\Models\HumanResources\User;
use App\Models\HumanResources\Voter;
use Illuminate\Support\Collection;

class GroupService{

    public function listGroup(User $user): Collection
    {
        $query = Group::query()->with('voters');
        if($user->hasRole('registrar')){
            $query->my( $user->id );
        }
        return $query->get()->map( function ( $s ) {
            return [
                'id'                => $s->id,
                'register_id'       => $s->register_id,
                'name'              => $s->description,
                'description'       => $s->description,
                'count_voters'      => $s->voters->count(),
                'created_at'        => $s->created_at_formatted,
                'created_at_time'   => $s->created_at_time_formatted,
            ];
        } );
    }

    public function findGroup( int $id, User $user ): Group
    {
        $query = Group::query()->with('voters');
        if($user->hasRole('registrar')){
            $query->my( $user->id );
        }
        return $query->findOrFail( $id );
    }

    public function createGroup(array $data): Group
    {
        $group = Group::create($data );
        return $group;
    }

    public function updateGroup(int $id, array $data, User $user): Group
    {
        $group = $this->findGroup( $id, $user );
        $group->update($data);
        return $group;
    }

    public function destroyGroup(int $id, User $user): string
    {
        $group = $this->findGroup( $id, $user );
        $description = $group->short_description;
        $group->delete();
        return $description;
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

    public function updateUserPassword(Group $group, $password): Group
    {
        $group->updatePassword( $password );
        return $group;
    }
    */
}