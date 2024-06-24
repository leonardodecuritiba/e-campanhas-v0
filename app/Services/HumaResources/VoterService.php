<?php
namespace App\Services\HumaResources;

use App\Models\HumanResources\User;
use App\Models\HumanResources\Voter;
use Illuminate\Support\Collection;

class VoterService{

    /**
     * Voter List.
     * User registrar only can view self voters
     *
     * @param User $user
     * @return Collection
     */
    public function listVoter(User $user): Collection
    {
        $query = Voter::query();
        if($user->hasRole('registrar'))
        {
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

    /**
     * Voter List.
     * User registrar only can view self voters
     *
     * @param int $id
     * @param User $user
     * @return Voter
     */
    public function findVoter( int $id, User $user ): Voter
    {
        $query = Voter::with('groups','address.state','address.city');
        if($user->hasRole('registrar')){
            $query->my( $user->id );
        } elseif($user->hasRole('coordinator')){ //Se o coordenador estiver olhando um eleitor que é um coordenador, admin ou root, não poderá editar
            $query->onlyRegistrarUsers( );
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
        $description = $voter->name;
        $voter->delete();
        return $description;
    }

    /**
     * Removeds Voters List.
     * User registrar only can view self voters
     *
     * @param User $user
     * @return Collection
     */
    public function listVoterRemoveds(User $user): Collection
    {
        $query = Voter::onlyTrashed();
        if($user->hasRole('registrar'))
        {
            $query->my( $user->id );
        } elseif($user->hasRole('coordinator')){ //Se o coordenador estiver olhando um eleitor que é um coordenador, admin ou root, não poderá editar
            $query->onlyRegistrarUsers( );
        }
        return $query->get()->map( function ( $s ) {
            return [
                'id'              => $s->id,
                'register_id'     => $s->register_id,
                'name'            => $s->name,
                'cpf_formatted'   => $s->cpf_formatted,
                'email'           => $s->email,
                'whatsapp_formatted'=> $s->whatsapp_formatted,
                'created_at'      => $s->created_at_formatted,
                'created_at_time' => $s->created_at_time_formatted,
                'deleted_at'      => $s->deleted_at_formatted,
                'deleted_at_time' => $s->deleted_at_time_formatted,
            ];
        } );
    }

    public function restoreVoter( int $id, User $user ): Voter
    {
        $query = Voter::withTrashed();
        if($user->hasRole('registrar'))
        {
            $query->my( $user->id );
        } elseif($user->hasRole('coordinator')){ //Se o coordenador estiver olhando um eleitor que é um coordenador, admin ou root, não poderá editar
            $query->onlyRegistrarUsers( );
        }
        $voter = $query->findOrFail( $id );
        $voter->restore();
        return $voter;
    }
}