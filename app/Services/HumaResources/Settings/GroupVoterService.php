<?php
namespace App\Services\HumaResources\Settings;

use App\Models\HumanResources\Voter;

class GroupVoterService{

    public function attachVoterWithGroup(int $voter_id, int $group_id): bool
    {
        $user = Voter::findOrFail($voter_id);
        $user->groups()->attach($group_id);
        return true;
    }

    public function detachVoterFromGroup(int $voter_id, int $group_id): bool
    {
        $user = Voter::findOrFail($voter_id);
        $user->groups()->detach($group_id);
        return true;
    }
}