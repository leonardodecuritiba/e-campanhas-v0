<?php

namespace App\Models\Commons;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class CepState extends Model {
	use SoftDeletes;
	public $timestamps = true;
	protected $fillable = [
		'name',
		'short_name',
	];

	protected $appends = [
		'short_description',
	];

	public function findCityByName( $value ) {

		return DB::table('cep_cities')
		    ->where('state_id', $this->id)
			->whereRaw( 'name Like "' . strtoupper( trim( $value ) ) . '"')->first();
		return $this->cities->where( 'name', 'like', '%' . strtoupper( trim( $value ) ) . '%' );
//		return $this->cities;
//			->where('name', trim($value))->first();
//		->where('name', 'like', '%'.trim($value).'%')->first();

//		return $value;
//		return $this->cities
//			->where('name', 'like', '%'.trim($value).'%');

//		return strtoupper(trim($value));

//		return strtoupper(trim($value));
//		return $this->cities;


        /*
		return $this->cities->where( function ( $q2 ) use ( $value ) {
			$q2->whereRaw( 'LOWER(`title`) like ?', array( trim( $value ) ) );
		} );


		return $this->cities
			->whereRaw( "name like '%$value%' collate utf8_general_ci " );
        */
	}

	public function getShortDescriptionAttribute()
    {
		return $this->attributes['name'];
	}

	static public function findByUf( $value )
    {
		return self::where( 'short_name', trim( $value ) )->first();
	}

	static public function getAlltoSelectList()
    {
		return self::get()->map( function ( $s ) {
			return [
				'id'          => $s->id,
				'description' => $s->name
			];
		} )->pluck( 'description', 'id' );
	}


	public function cities()
    {
		return $this->hasMany( CepCity::class, 'state_id' );
	}
}
