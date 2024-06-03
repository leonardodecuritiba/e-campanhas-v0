<?php

namespace App\Models\HumanResources;

use App\Helpers\DataHelper;
use App\Models\HumanResources\Settings\Address;
use App\Models\HumanResources\Settings\Contact;
use App\Models\Transactions\Request;
use App\Traits\ActiveTrait;
use App\Traits\DateTimeTrait;
use App\Traits\StringTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Voter extends Model
{
	use SoftDeletes;
    use DateTimeTrait;
    use StringTrait;
    use ActiveTrait;
	public $timestamps = true;
	static public $img_path = 'voters';

	protected $fillable = [
		'address_id',
		'contact_id',
		'user_id',

		'name',
		'surname',
        'cpf',
        'cnpj',

		'active',
	];

	protected $appends = [
		'cpf_formatted',
		'cnpj_formatted',
		'short_description',
		'short_document'
	];


	//============================================================
	//======================== FUNCTIONS =========================
	//============================================================


	//============================================================
	//======================== ACCESSORS =========================
	//============================================================

    public function getShortName()
    {
	    return $this->name;
    }

    public function getName()
    {
	    return $this->short_description;
    }
    public function isLegalPerson()
    {
	    return ($this->getAttribute('cpf') != NULL);
    }

	public function getShortDescriptionAttribute()
	{
        return ($this->getAttribute('name') != NULL) ? $this->getAttribute('name') : $this->getAttribute('surname');
	}

	public function getShortDocumentAttribute()
	{
        return ($this->getAttribute('cpf') != NULL) ? $this->cpf_formatted : $this->cnpj_formatted;
	}

	public function getCpfFormattedAttribute()
	{
		return DataHelper::mask($this->getAttribute('cpf'), '###.###.###-##');
	}

    public function getCnpjFormattedAttribute()
    {
        return DataHelper::mask($this->getAttribute('cnpj'), '##.###.###/####-##' );
    }


	//============================================================
	//======================== MUTATORS ==========================
	//============================================================

    public function setCnpjAttribute( $value )
    {
        return $this->attributes['cnpj'] = DataHelper::getOnlyNumbers( $value );
    }

    public function setCpfAttribute( $value )
    {
        return $this->attributes['cpf'] = DataHelper::getOnlyNumbers( $value );
    }
    //============================================================
    //======================== SCOPE =============================
    //============================================================

    public function scopeMy($query)
    {
        $u = Auth::user();
        return $query->where('user_id', $u->id);
    }


    static public function itsMy($client_id)
    {
        return self::my()->where('id', $client_id)->exists();
    }

	//============================================================
	//======================== FUNCTIONS =========================
	//============================================================



	//============================================================
	//======================== RELASHIONSHIP =====================
	//============================================================

	//======================== FUNCTIONS =========================



	//======================== BELONGS ===========================


	public function address()
	{
		return $this->belongsTo(Address::class, 'address_id');
	}

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'contact_id');
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	//======================== HASONE ============================

	//======================== HASMANY ===========================
    public function requests()
    {
        return $this->hasMany(Request::class, 'client_id');
    }

    public function paid_requests()
    {
        return $this->requests()->paid();
    }

    public function billed_requests()
    {
        return $this->requests()->billed();
    }

    public function requests_last_months($months = 3)
    {
        $begin = Carbon::now();
        $end = clone $begin;
        $begin->subMonths($months);
        return $this->paid_requests()->whereBetween('created_at',[$begin->toDateString(), $end->toDateString()]);
    }



}
