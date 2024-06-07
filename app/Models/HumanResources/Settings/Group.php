<?php

namespace App\Models\HumanResources\Settings;

use App\Traits\OLD\DateTimeTrait;
use App\Traits\OLD\StringTrait;
use Illuminate\Database\Eloquent\Model;

class Group extends Model {
	use DateTimeTrait;
	use StringTrait;
	public $timestamps = true;
	protected $fillable = [
		'description',
	];

	protected $appends = [
		'created_at_formatted',
		'created_at_human_formatted',
		'short_description',
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
	public function scopeActive($query)
	{
		return $query;
	}

	//============================================================
	//======================== RELASHIONSHIP =====================
	//============================================================
	/**
	 * The entities that belong to the group.
	 */
//	public function voters()
//	{
//		return $this->belongsToMany(Voter::class)
//		            ->using(EntityGroup::class)
//		            ->withTimestamps();
//	}
}
