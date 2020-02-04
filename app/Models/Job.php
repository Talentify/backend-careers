<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Job
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $status
 * @property mixed|null $workplace
 * @property float|null $salary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static Builder|\App\Models\Job newModelQuery()
 * @method static Builder|\App\Models\Job newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Job onlyTrashed()
 * @method static Builder|\App\Models\Job query()
 * @method static bool|null restore()
 * @method static Builder|\App\Models\Job whereCreatedAt($value)
 * @method static Builder|\App\Models\Job orderBy($value)
 * @method static Builder|\App\Models\Job whereDeletedAt($value)
 * @method static Builder|\App\Models\Job whereDescription($value)
 * @method static Builder|\App\Models\Job whereId($value)
 * @method static Builder|\App\Models\Job whereRaw($value)
 * @method static Builder|\App\Models\Job whereJsonContains($json, $value)
 * @method static Builder|\App\Models\Job whereSalary($value)
 * @method static Builder|\App\Models\Job whereStatus($value)
 * @method static Builder|\App\Models\Job whereTitle($value)
 * @method static Builder|\App\Models\Job whereUpdatedAt($value)
 * @method static Builder|\App\Models\Job whereWorkplace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Job withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Job withoutTrashed()
 */
class Job extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'title',
        'description',
        'status',
        'workplace',
        'salary',
        'updated_at',
        'deleted_at'
    ];

    protected $hidden = [
        'deleted_at', 'pivot'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function getSalaryAttribute()
    {
        if($this->attributes['salary'] === null){
            return null;
        }

        return number_format($this->attributes['salary'], 2, '.', '');
    }

    public function getWorkplaceAttribute()
    {
        if($this->attributes['workplace'] === null){
            return null;
        }

        return json_decode($this->attributes['workplace'], true);
    }

    public function setWorkplaceAttribute($value)
    {
        $this->attributes['workplace'] = ($value !== null) ? json_encode($value) : $value;

        return json_encode($value);
    }
}
