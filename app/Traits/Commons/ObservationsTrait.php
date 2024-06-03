<?php

namespace App\Traits\Commons;

use App\Models\Commons\Observation;

trait ObservationsTrait {

    public function observations()
    {
        return $this->hasMany(Observation::class, "parent_id")
            ->where("type", $this->getTable());
    }
}