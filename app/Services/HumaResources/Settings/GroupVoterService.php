<?php
namespace App\Services\HumaResources\Settings;

use App\Models\HumanResources\User;
use App\Models\HumanResources\Voter;

class GroupVoterService {

    private function findVoter(int $voter_id, User $user): Voter
    {
        $query = Voter::query();
        if($user->hasRole('registrar')){
            $query->my( $user->id );
        } elseif($user->hasRole('coordinator')){ //Se o coordenador estiver olhando um eleitor que é um coordenador, admin ou root, não poderá editar
            $query->onlyRegistrarUsers( );
        }
        return $query->findOrFail( $voter_id );
    }

    public function attachVoterWithGroup(int $voter_id, int $group_id, User $user): bool
    {
        $voter = $this->findVoter( $voter_id, $user );
        $voter->groups()->attach($group_id);
        return true;
    }

    public function detachVoterFromGroup(int $voter_id, int $group_id, User $user): bool
    {
        $voter = $this->findVoter( $voter_id, $user );
        $voter->groups()->detach($group_id);
        return true;
    }
}