<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name'];

    public function getResults($name = null)
    {
        if(!$name)
            return $this->get();

        return $this->where('name', 'ILIKE', "%{$name}%")->get();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
