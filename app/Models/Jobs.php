<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Jobs extends Model
{
    use HasFactory;

    /**
     * Limit per page.
     */
    const LIMIT_PER_PAGE = 6;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'salary',
        'status',
        'workplace'
    ];

    /**
     *  Get jobs
     *
     * @param int $page
     * @return mixed
     */
    public static function getJobs($page = 0)
    {
        $query = self::limit(self::LIMIT_PER_PAGE)->orderBy('id', 'desc');
        if (!Auth::user()) {
            $query->where('status', JobsStatus::ENABLE);
        }
        if ($page > 0) {
            $query->limit(self::LIMIT_PER_PAGE)->offset(self::LIMIT_PER_PAGE * $page);
        }
        return $query->get();
    }
}
