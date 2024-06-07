<?php

namespace App\Traits\OLD;

use Illuminate\Support\Str;

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

    public function getShortName()
    {
        return Str::limit($this->getName(), 20);
    }

    public function getShortContent()
    {
        return Str::limit($this->getContent(), 50);
    }

}