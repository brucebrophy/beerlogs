<?php

namespace App\Models\Beers;

use Illuminate\Database\Eloquent\Model;

class Hop extends Model
{
    protected $guarded = [];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}
