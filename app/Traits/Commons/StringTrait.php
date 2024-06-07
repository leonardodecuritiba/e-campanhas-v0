<?php

namespace App\Traits\Commons;

trait StringTrait {

    static public function getAlltoSelectList() {
        return self::active()->get()->map( function ( $s ) {
            return [
                'id'          => $s->id,
                'description' => $s->getName()
            ];
        } )->pluck( 'description', 'id' );
    }

    static public function getAlltoTypeHeadList() {
        return self::active()->get()->map( function ( $s ) {
            return [
                'id'    => $s->id,
                'text'  => $s->getName()
            ];
        } );
    }

}