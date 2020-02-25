<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Jobs extends Model
{
    protected $fillable = [
        'uuid',
        'company',
        'title',
        'description',
        'status',
        'workplace',
        'salary',
        'contact'
    ];

    /**
     * @param $value
     */
    public function setCompanyAttribute($value)
    {
        $this->attributes['company'] = Utilities::cleanString($value);
    }

    /**
     * @param $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title(Utilities::cleanString($value));
    }

    /**
     * @param $value
     */
    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = Str::title(Str::limit(Utilities::cleanString($value), 10000, $end = '...'));
    }

    /**
     * @param $value
     */
    public function setWorkplaceAttribute($value)
    {
        $this->attributes['workplace'] = Str::title(Utilities::cleanString($value));
    }

    /**
     * @param $value
     */
    public function setSalaryAttribute($value)
    {
        $this->attributes['salary'] = Utilities::formatValueUs($value);
    }

    /**
     * @param $value
     */
    public function setContactAttribute($value)
    {
        $this->attributes['contact'] = $value;
    }

    /**
     * @param $value
     * @return false|string
     */
    public function getCreatedAtAttribute(?string $value)
    {
        return Utilities::formatDateToBr($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getSalaryAttribute($value)
    {
        return Utilities::formatValueBr($value);
    }
}
