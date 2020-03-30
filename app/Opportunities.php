<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Opportunities extends Model implements Searchable
{
    protected $fillable = ['title', 'description', 'status', 'workplace', 'salary'];

    public function getSearchResult(): SearchResult
    {
        $url = route('opportunities.show', $this->id);

        $search = new SearchResult(
            $this,
            $this->title,
            $url
        );

        return $search;
    }
}
