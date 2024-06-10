<?php

namespace App\Models\HumanResources;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use App\Traits\Commons\ActiveTrait;
use App\Traits\Commons\DateTimeTrait;
use App\Traits\HumanResources\User\NotificationTrait;
use App\Traits\HumanResources\User\UserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
//    use StringTrait;
    use UserTrait;
    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable;
    use DateTimeTrait;
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
        'status',
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

    /**
     * The relationships that should be brought.
     *
     * @var array<int, string>
     */
    protected $with = [
        'roles',
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

    static public function getAlltoSelectList()
    {
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
    public function voter(): HasOne
    {
        return $this->hasOne(Voter::class, 'user_id');
    }

    //======================== HASMANY ===========================
    //============================================================

}
