<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Company",
 *     description="Company Model",
 *     @OA\Xml(
 *         name="Company"
 *     )
 * )
 */
class Company extends Model
{
    /**
     * @OA\Property(
     *     title="id",
     *     description="id da Empresa",
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
     *     description="Name da Empresa",
     *     format="string",
     *     example="Talentify"
     * )
     *
     * @var integer
     */
    public $namee;

    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * 1 company has 1 recruiter
     */
    public function recruiter()
    {
        return $this->hasOne(Recruiter::class, 'company_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * One Company has Many Positions
     */
    public function positions()
    {
        return $this->hasMany(Position::class);
    }
}
