<?php
namespace App\Services\HumaResources;

use App\Models\HumanResources\Voter;

class VoterService{

    public function createVoter(array $data): Voter
    {
        $voter = Voter::create($data );
        return $voter;
    }

    public function updateVoter(Voter $voter, array $data): Voter
    {
        $voter->update($data);
        return $voter;
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