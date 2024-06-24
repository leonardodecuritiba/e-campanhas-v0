<?php

namespace App\Models\HumanResources;

use App\Models\HumanResources\Settings\Address;
use App\Models\HumanResources\Settings\Group;
use App\Models\HumanResources\Settings\GroupVoter;
use App\Models\HumanResources\Settings\Role;
use App\Traits\Commons\ActiveTrait;
use App\Traits\Commons\DateTimeTrait;
use App\Traits\Commons\StringTrait;
use App\Traits\Commons\FileTrait;
use App\Traits\HumanResources\VoterFieldsTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Voter extends Model
{
    use StringTrait;
    use DateTimeTrait;
    use VoterFieldsTrait;
    use ActiveTrait;
    use SoftDeletes;
    use HasFactory;
    use FileTrait;

	public $timestamps = true;
    static private $file_folder = 'voters';
    static private $field_filename = 'image';
    static private $file_mode = 'self';

	protected $fillable = [
        'register_id',
        'address_id',
//        'user_id',
//        'sponsor_id',

        'name',
        'surname',
        'birthday',
        'years_approximate',
        'image',

        'death',
        'death_date',

        'cpf',
        'email',
        'whatsapp',
        'other_phones',
        'instagram',

        'voter_registration_zone',
        'voter_registration_session',
        'location_of_operation',
        'social_history',
        'votes_estimate',
        'votes_degree_certainty',

        'status',
	];

	protected $appends = [
	];


	//============================================================
	//======================== FUNCTIONS =========================
	//============================================================

    /**
     * Scope the model query to certain roles only.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyRegistrarUsers(Builder $query): Builder
    {
        return $query->where(function ($query) {
            $query->whereHas('user.roles', function ($q) {
                $q->where('name', 'registrar');
            })->orWhereNull('user_id');
        });
    }

	//============================================================
	//======================== ACCESSORS =========================
	//============================================================
    public function getName()
    {
	    return $this->name;
    }

	public function getShortDescriptionAttribute()
	{
        return $this->name;
    }

	//============================================================
	//======================== MUTATORS ==========================
	//============================================================

    public function setImageAttribute($value)
    {
        return $this->setFileAttribute( $value );
    }

    //============================================================
    //======================== SCOPE =============================
    //============================================================

    public function scopeMy(Builder $query, int $id): void
    {
        $query->where('register_id', $id);
    }
//
//    static public function itsMy($client_id)
//    {
//        return self::my()->where('id', $client_id)->exists();
//    }

	//============================================================
	//======================== FUNCTIONS =========================
	//============================================================


	//============================================================
	//======================== RELASHIONSHIP =====================
	//============================================================

    //======================== BELONGS ===========================
    //============================================================

    public function register(): BelongsTo
    {
        return $this->belongsTo(User::class, 'register_id');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sponsor(): BelongsTo
    {
        return $this->belongsTo(self::class, 'sponsor_id');
    }

    //======================== HASONE ============================
    //============================================================

    //======================== HASMANY ===========================
    //============================================================
    public function sponsoreds(): HasMany
    {
        return $this->hasMany(self::class, 'sponsor_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class)->using(GroupVoter::class)->withTimestamps();
    }

}
