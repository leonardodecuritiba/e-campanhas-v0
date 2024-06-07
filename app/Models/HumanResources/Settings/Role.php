<?php

namespace App\Models\HumanResources\Settings;

use App\Traits\OLD\DateTimeTrait;
use Spatie\Permission\Models\Role as RoleSpatie;

class Role extends RoleSpatie
{
    use DateTimeTrait;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $appends = [
        'created_at_time',
        'created_at_formatted',
    ];

    static public function getAlltoSelectList()
    {
        return self::get()->map( function ( $s ) {
            return [
                'id'          => $s->id,
                'description' => $s->name
            ];
        } )->pluck( 'description', 'id' );
    }

    public function getShortName()
    {
        return $this->name;
    }
}
