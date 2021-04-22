<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @OA\Schema(
 *     title="Recruiter",
 *     description="Recruiter Model",
 *     @OA\Xml(
 *         name="Recruiter"
 *     )
 * )
 */
class Recruiter extends Authenticatable implements JWTSubject
{
    /**
     * @OA\Property(
     *     title="id",
     *     description="id do Recrutador",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $idd;

    /**
     * @OA\Property(
     *     title="name",
     *     description="Name do Recrutador",
     *     format="string",
     *     example="Talentify"
     * )
     *
     * @var integer
     */
    public $namee;

    /**
     * @OA\Property(
     *     title="email",
     *     description="Email do Recrutador",
     *     format="string",
     *     example="contato@email.com"
     * )
     *
     * @var integer
     */
    public $emaill;

    /**
     * @OA\Property(
     *     title="password",
     *     description="Senha do Recrutador",
     *     format="string",
     *     example="123456"
     * )
     *
     * @var integer
     */
    public $passwordd;

    /**
     * @OA\Property(
     *     title="company_id",
     *     description="id da empresa onde o Recrutador trabalha",
     *     format="integer",
     *     example="1"
     * )
     *
     * @var integer
     */
    public $company_idd;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'id' => $this->id,
            'email' => $this->email
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 1 recruiter belongs to 1 company
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * One Recruitar can Add many Positions
     */
    public function positions()
    {
        return $this->hasMany(Position::class);
    }
}
