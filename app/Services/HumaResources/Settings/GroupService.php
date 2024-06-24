<?php
namespace App\Services\HumaResources\Settings;

use App\Models\HumanResources\Settings\Group;
use App\Models\HumanResources\User;
use App\Models\HumanResources\Voter;
use App\Services\MainService;
use Illuminate\Support\Collection;

class GroupService extends MainService {

    /**
     * Group List.
     * User registrar only can view self voters
     *
     * @param User $user
     * @return Collection
     */
    public function listGroup(User $user): Collection
    {
        $query = Group::query()->with('voters');
        if($user->hasRole('registrar'))
        {
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

    /**
     * Group List.
     * User registrar only can view self voters
     *
     * @param User $user
     * @return Collection
     */
    public function listGroupRemoveds(User $user): Collection
    {
        $query = Group::onlyTrashed();
        if($user->hasRole('registrar'))
        {
            $query->my( $user->id );
        }
        return $query->get()->map( function ( $s ) {
            return [
                'id'              => $s->id,
                'register_id'     => $s->register_id,
                'description'     => $s->description,
                'created_at'      => $s->created_at_formatted,
                'created_at_time' => $s->created_at_time_formatted,
                'deleted_at'      => $s->deleted_at_formatted,
                'deleted_at_time' => $s->deleted_at_time_formatted,
            ];
        } );
    }

    public function restoreGroup( int $id, User $user ): Group
    {
        $query = Group::withTrashed();
        if($user->hasRole('registrar'))
        {
            $query->my( $user->id );
        }
        $group = $query->findOrFail( $id );
        $group->restore();
        return $group;
    }

    public function getAvailableGroupsForVoter( Voter $voter, User $user, string $term ): Collection
    {
        // Obtém os IDs dos grupos já associados ao eleitor
        $associatedGroupIds = $voter->groups()->pluck('groups.id');
        // Obtém os grupos disponíveis
        $query = Group::whereNotIn('id', $associatedGroupIds)->where('description','like','%'.$term.'%');
        if($user->hasRole('registrar'))
        {
            $query->my( $user->id );
        }
        return $query->get(['id', 'description']);
    }
}