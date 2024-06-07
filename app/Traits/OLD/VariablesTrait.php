<?php

namespace App\Traits\OLD;

trait VariablesTrait {


    static public function getAlltoSelectList() {
        return self::all()->map( function ( $s ) {
            return [
                'id'          => $s['id'],
                'description' => isset($s['description']) ? $s['description'] : $s['code']
            ];
        } )->pluck( 'description', 'id' );
    }

	static public function all($columns = NULL)
	{
	    $collect = collect(config('variables.' . self::_NAME_));
		return ($columns == NULL) ? $collect : $collect->map(function ($d) use ($columns) {
			$x = [];
			foreach ($columns as $c){
				$x[$c] = $d[$c];
			}
			return $x;
		});


	    if($columns != NULL){
            return $collect->get($columns);
        }
		return $collect;
	}

	static public function whereId($attribute)
	{
		return (object) self::all()->where('id', $attribute)->first();
	}

	static public function whereCode($attribute)
	{
		return (object) self::all()->where('code', $attribute)->first();
	}

	static public function whereDescription($attribute)
	{
		$data = self::all()->where('description', $attribute)->first();
		return ($data!=NULL) ? (object) $data : $data;
	}

}