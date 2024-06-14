<?php

namespace App\Models\HumanResources\Settings;

use App\Models\HumanResources\User;
use App\Models\HumanResources\Voter;
use App\Traits\Commons\ActiveTrait;
use App\Traits\Commons\DateTimeTrait;
use App\Traits\Commons\StringTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
	use StringTrait;
	use DateTimeTrait;
    use ActiveTrait;
    use SoftDeletes;
    use HasFactory;

	public $timestamps = true;
	protected $fillable = [
		'description',
        'status',
	];

	//============================================================
	//======================== FUNCTIONS =========================
	//============================================================

	public function getName()
	{
		return $this->getAttribute('description');
	}

	public function getShortDescriptionAttribute()
	{
		return $this->getName();
	}

	//============================================================
	//======================== SCOPE =============================
	//============================================================



    //============================================================
    //======================== RELASHIONSHIP =====================
    //============================================================

    //======================== BELONGS ===========================
    //============================================================

    //======================== HASONE ============================
    //============================================================

    //======================== HASMANY ===========================
    //============================================================
    public function voters()
    {
        return $this->belongsToMany(Voter::class)->using(GroupVoter::class)->withTimestamps();
    }
}
