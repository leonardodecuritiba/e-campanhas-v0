<?php

namespace App\Models\HumanResources\Settings;

use App\Traits\Commons\DateTimeTrait;
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
        'name_formatted',
        'created_at_time',
        'created_at_formatted',
    ];

//    static public function getAlltoSelectList()
//    {
//        return self::get()->map( function ( $s ) {
//            return [
//                'id'          => $s->id,
//                'description' => $s->name
//            ];
//        } )->pluck( 'description', 'id' );
//    }

    public function getShortName()
    {
        return $this->name;
    }

    public function getNameFormattedAttribute()
    {
        switch ($this->name){
            case 'root':
                return 'Root';
            case 'admin':
                return 'Administrador';
            case 'coordinator':
                return 'Coordenador';
            case 'registrar':
                return 'Cabo Eleitoral';
        }
    }
}
