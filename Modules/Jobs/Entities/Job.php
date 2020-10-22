<?php


namespace Modules\Jobs\Entities;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Modules\Jobs\Database\factories\JobFactory;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    protected $fillable = ['title', 'description', 'status', 'workplace', 'salary'];

    const AllOWED_STATUS = [
        'open',
        'closed'
    ];

    public function getRules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:10000'],
            'status' => ['required', Rule::in(self::AllOWED_STATUS)],
            'workplace' => ['string', 'max:255'],
            'salary' => ['integer', 'min:0']
        ];
    }

    protected static function newFactory()
    {
        return JobFactory::new();
    }

}
