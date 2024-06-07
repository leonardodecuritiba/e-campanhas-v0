<?php

namespace App\Models\HumanResources\Settings;

use App\Helpers\DataHelper;
use App\Traits\Commons\ActiveTrait;
use App\Traits\OLD\DateTimeTrait;
use App\Traits\OLD\StringTrait;
use Database\Factories\old\ContactFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
	use SoftDeletes;
	use DateTimeTrait;
	use StringTrait;
	use ActiveTrait;
	use HasFactory;
	public $timestamps = true;
	protected $fillable = [
		'phone',
		'cellphone',
		'email_contact',
	];

	protected $appends = [
		'phone_formatted',
		'cellphone_formatted',
	];

    //============================================================
	//======================== ACCESSORS =========================
	//============================================================

	public function getPhoneFormattedAttribute()
	{
		return DataHelper::mask( $this->attributes['phone'], '(##)####-####' );
	}

	public function getCellphoneFormattedAttribute()
	{
		return DataHelper::mask( $this->attributes['cellphone'], '(##)#####-####' );
	}

	//============================================================
	//======================== MUTATORS ==========================
	//============================================================

	public function setPhoneAttribute( $value )
	{
		return $this->attributes['phone'] = DataHelper::getOnlyNumbers( $value );
	}

	public function setCellphoneAttribute( $value )
	{
		return $this->attributes['cellphone'] = DataHelper::getOnlyNumbers( $value );
	}

	//============================================================
	//======================== FUNCTIONS =========================
	//============================================================
    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory()
    {
        return ContactFactory::new();
    }

	public function getName()
	{
		return $this->getAttribute('description');
	}

	public function getContent()
	{
		return $this->getAttribute('description');
	}

	//============================================================
	//======================== RELASHIONSHIP =====================
	//============================================================
//	static public function getAlltoSelectList() {
//		return self::get()->map( function ( $s ) {
//			return [
//				'id'          => $s->idmarca,
//				'description' => $s->descricao
//			];
//		} )->pluck( 'description', 'id' );
//	}

	//============================================================
	//======================== HASONE ============================
	//============================================================

}
