<?php

namespace App\Models\HumanResources;

use App\Models\Commons\Expense;
use App\Models\Commons\Observation;
use App\Models\Moviments\Contract;
use App\Traits\StringTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use App\Traits\ActiveTrait;
use App\Traits\AddressTrait;
use App\Traits\DateTimeTrait;
use App\Traits\User\NotificationTrait;
use App\Traits\UserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable;
    use DateTimeTrait;
    use StringTrait;
    use UserTrait;
    use AddressTrait;
    use ActiveTrait;
    use Notifiable;
    use NotificationTrait;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $appends = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


	//============================================================
	//======================== FUNCTIONS =========================
	//============================================================
    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    static public function getAlltoSelectList() {
        return self::get()->map( function ( $s ) {
            return [
                'id'          => $s->id,
                'description' => $s->getName()
            ];
        } )->pluck( 'description', 'id' );
    }

    //============================================================
    //======================== ACCESSORS =========================
    //============================================================
    //============================================================
    //======================== MUTATORS ==========================
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

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'owner_id');
    }

    public function owner_expenses()
    {
        return $this->hasMany(Expense::class, 'owner_id');
    }

    public function approver_expenses()
    {
        return $this->hasMany(Expense::class, 'approver_id');
    }

    public function observations()
    {
        return $this->hasMany(Observation::class, 'owner_id');
    }

}
