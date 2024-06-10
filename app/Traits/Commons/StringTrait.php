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


    static public function mask( $val, $mask ) {
        if ( $val != null || $val != "" ) {
            $maskared = '';
            $k        = 0;
            for ( $i = 0; $i <= strlen( $mask ) - 1; $i ++ ) {
                if ( $mask[ $i ] == '#' ) {
                    if ( isset( $val[ $k ] ) ) {
                        $maskared .= $val[ $k ++ ];
                    }
                } else {
                    if ( isset( $mask[ $i ] ) ) {
                        $maskared .= $mask[ $i ];
                    }
                }
            }
        } else {
            $maskared = null;
        }

        return $maskared;
    }

}