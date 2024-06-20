<?php
namespace App\Services\HumaResources;

use App\Models\HumanResources\User;
use App\Models\HumanResources\Voter;
use Illuminate\Support\Collection;

class VoterService{

    public function listVoter(User $user): Collection
    {
        $query = Voter::query();
        if($user->hasRole('registrar')){
            $query->my( $user->id );
        }
        return $query->get()->map( function ( $s ) {
            return [
                'id'                => $s->id,
                'register_id'       => $s->register_id,
                'name'              => $s->name,
                'cpf_formatted'     => $s->cpf_formatted,
                'email'             => $s->email,
                'whatsapp_formatted'=> $s->whatsapp_formatted,
                'created_at'        => $s->created_at_formatted,
                'created_at_time'   => $s->created_at_time_formatted,
            ];
        } );
    }

    public function findVoter( int $id, User $user ): Voter
    {
        $query = Voter::query()->with('groups','address.state','address.city');
        if($user->hasRole('registrar')){
            $query->my( $user->id );
        }
        return $query->findOrFail( $id );
    }

    public function createVoter(array $data): Voter
    {
        $voter = Voter::create($data );
        return $voter;
    }

    public function updateVoter(int $id, array $data, User $user): Voter
    {
        $voter = $this->findVoter( $id, $user );
        $voter->update($data);
        return $voter;
    }

    public function destroyVoter(int $id, User $user): string
    {
        $voter = $this->findVoter( $id, $user );
        $description = $voter->description;
        $voter->delete();
        return $description;
    }

    public function restoreVoter( int $id): Voter
    {
        $voter = Voter::withTrashed()->findOrFail( $id );
        $voter->restore();
        return $voter;
    }
    
    
    /*

    public function findUser( int $id): Voter
    {
        return Voter::findOrFail( $id );
    }

    public function updateUserPassword(Voter $voter, $password): Voter
    {
        $voter->updatePassword( $password );
        return $voter;
    }
    */
}