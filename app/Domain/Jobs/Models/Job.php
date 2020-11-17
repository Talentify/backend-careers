<?php

namespace Domain\Jobs\Models;

use Core\DTOs\AbstractDTOInterface;
use Core\Models\AbstractModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Domain\Jobs\DTOs\JobDTO;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

/**
 * @property string $id
 * @property string $address_id
 * @property string $description
 * @property double $salary
 * @property string $slug
 * @property int $status
 * @property string $user_id
 * @property string $title
 * @property Address $address
 */
class Job extends AbstractModel implements JobInterface
{
    use HasFactory;
    use Searchable;
    use Sluggable;

    protected $table = 'jobs';

    protected $keyType = 'string';

    protected $fillable = [
        self::ATT_ADDRESS_ID,
        self::ATT_DESCRIPTION,
        self::ATT_SALARY,
        self::ATT_SLUG,
        self::ATT_STATUS,
        self::ATT_TITLE,
    ];

    protected $casts = [
        self::ATT_ADDRESS_ID => 'string',
        self::ATT_DESCRIPTION => 'string',
        self::ATT_SALARY => 'decimal:2',
        self::ATT_SLUG => 'string',
        self::ATT_STATUS => 'integer',
        self::ATT_TITLE => 'string',
        self::ATT_USER_ID => 'string'
    ];

    protected $with = ['address'];

    protected $hidden = [
        self::ATT_USER_ID,
        self::ATT_ADDRESS_ID
    ];

    protected static function booted()
    {
        if (Auth::check() && Route::is('admin/*')) {
            static::addGlobalScope(
                'user_tenancy',
                function (Builder $builder) {
                    $builder->where('user_id', '=', Auth::id());
                }
            );
        }
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::ATT_USER_ID, 'id');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, self::ATT_ADDRESS_ID, 'id');
    }

    public function getSalaryAttribute($value)
    {
        return (float)$value;
    }

    public function toSearchableArray()
    {
        /**
         * toda indexação de termos é jogada em lower case para melhor indexação
         */
        return array_filter(
            [
                Str::lower($this->title),
                Str::lower($this->description),
                Str::lower($this->salary)
            ]
        );
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => self::ATT_TITLE
            ]
        ];
    }

    public function toDTO(): AbstractDTOInterface
    {
        return new JobDTO($this->toArray());
    }
}
