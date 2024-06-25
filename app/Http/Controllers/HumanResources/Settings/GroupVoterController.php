<?php

namespace App\Http\Controllers\HumanResources\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\HumanResources\Settings\GroupVoter\AttachRequest;
use App\Http\Requests\HumanResources\Settings\GroupVoter\DetachRequest;
use App\Services\HumaResources\Settings\GroupVoterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class GroupVoterController extends Controller
{
    protected $groupVoterService;

    public function __construct(GroupVoterService $groupVoterService)
    {
        parent::__construct();
        $this->groupVoterService = $groupVoterService;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param AttachRequest $request
     * @return RedirectResponse
     */
    public function attach(AttachRequest $request)
    {
        $voter_id = $request->voter_id;
        $group_id = $request->group_id;
        $result = $this->groupVoterService->attachVoterWithGroup($voter_id, $group_id);
        /*
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Voter associated with group successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to associate user with group']);
        }
        */
        return Redirect::route('voters.edit', $voter_id);

    }

    /**
     * Display the specified resource.
     *
     * @param DetachRequest $request
     * @return JsonResponse
     */
    public function detach(DetachRequest $request)
    {
        $voter_id = $request->voter_id;
        $group_id = $request->group_id;
        $result = $this->groupVoterService->detachVoterFromGroup($voter_id, $group_id);
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Voter dissociated with group successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to dissociate user with group']);
        }
    }
}
