<?php

namespace App\Models\Commons;

use App\Traits\Configurations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CepCity extends Model {
	use SoftDeletes;
	public $timestamps = true;
	protected $fillable = [
		'state_id',
		'name'
	];

	public function getShortStateName()
    {
		return $this->state->getShortName();
	}

	public function getShortName()
    {
		return $this->getAttribute( 'name' );
	}

	public function getShortNameState()
    {
		return $this->getAttribute( 'name' ) . ' / ' . $this->getShortStateName();
	}

	static public function findOrFailByStateId( $state_id )
    {
		return self::where('state_id', $state_id);
	}

	public function state()
    {
		return $this->belongsTo( CepState::class, 'state_id' );
	}
}
