<?php

namespace App\Hops;

use App\Beers\Recipe;
use Illuminate\Database\Eloquent\Model;

class Hop extends Model
{
    protected $guarded = [];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}
