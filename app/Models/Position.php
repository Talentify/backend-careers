<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Position",
 *     description="Position Model",
 *     @OA\Xml(
 *         name="Position"
 *     )
 * )
 */
class Position extends Model
{
    /**
     * @OA\Property(
     *     title="id",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $idd;

    /**
     * @OA\Property(
     *      title="title",
     *      description="Título da Vaga",
     *      example="Senior Developer"
     * )
     *
     * @var string
     */
    public $titlee;

    /**
     * @OA\Property(
     *      title="description",
     *      description="Descrição da Vaga",
     *      example="Vaga para Atuar no Densenvolvimento de Sistemas"
     * )
     *
     * @var string
     */
    public $descriptionn;

    /**
     * @OA\Property(
     *      title="address",
     *      description="Endereço da Vaga",
     *      example="Avenida São Paulo, 273 - SP"
     * )
     *
     * @var string
     */
    public $adrresss;

    /**
     * @OA\Property(
     *      title="salary",
     *      description="Salario oferecido para a vaga",
     *      example="13000"
     * )
     *
     * @var float
     */
    public $salaryy;

    /**
     * @OA\Property(
     *      title="status",
     *      description="Status da Vaga",
     *      example="Aberta"
     * )
     *
     * @var string
     */
    public $statuss;

    /**
     * @OA\Property(
     *      title="company_id",
     *      description="Empresa que oferece a Vaga",
     *      example="Talentify"
     * )
     *
     * @var string
     */
    public $company_idd;

    /**
     * @OA\Property(
     *      title="recruiter_id",
     *      description="Recrutador que cadastrou a Vaga",
     *      example="Vinicius"
     * )
     *
     * @var string
     */
    public $recruiter_idd;

    protected $fillable = [
        'title', 'description', 'address', 'salary', 'status', 'company_id', 'recruiter_id'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * One Position belongs to only One Company
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * One Position is Added by Only One Recruiter
     */
    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class);
    }
}
