<?php

namespace App\Models\HumanResources\Settings;

use App\Models\HumanResources\Voter;
use App\Traits\Commons\DateTimeTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupVoter extends Pivot
{
    use DateTimeTrait;
    protected $table = 'group_voter';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    public function voter(): BelongsTo
    {
        return $this->belongsTo(Voter::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
