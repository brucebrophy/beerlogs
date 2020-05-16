<?php

namespace App\Malts;

use App\Beers\Recipe;
use Illuminate\Database\Eloquent\Model;

class Malt extends Model
{
    protected $guarded = [];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}
