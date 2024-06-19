<?php

namespace App\Models\HumanResources\Settings;

use App\Models\Commons\CepCities;
use App\Models\Commons\CepStates;
use App\Models\HumanResources\Voter;
use App\Traits\HumanResources\Settings\AddressTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model {
	use SoftDeletes;
	use AddressTrait;
	use HasFactory;
	public $timestamps = true;
	protected $fillable = [
		'state_id',
		'city_id',

		'zip',
		'district',
		'street',
		'number',
		'complement',
		'region',
		'geolocalization',
	];

	protected $with = array( 'state', 'city' );

	protected $appends = [
		'city_name',
		'uf_name',
		'city_uf'
	];


    /**
     * The attributes that are spatial fields.
     *
     * @var array
     */
    protected $spatialFields = [
        'geolocalization',
    ];

	//============================================================
	//======================== ACCESSORS =========================
	//============================================================

	//============================================================
	//======================== MUTATORS ==========================
	//============================================================

    //============================================================
    //======================== FUNCTIONS =========================
    //============================================================

    //============================================================
    //======================== RELASHIONSHIPS ====================
    //============================================================
	// ********************  ******************************

	public function state()
    {
		return $this->belongsTo( CepStates::class, 'state_id' );
	}

	public function city() {
		return $this->belongsTo( CepCities::class, 'city_id', 'id' );
	}

    //============================================================
    //======================== HASONE ============================
    //============================================================

    public function voter()
    {
        return $this->hasOne( Voter::class, 'address_id' );
    }

}
