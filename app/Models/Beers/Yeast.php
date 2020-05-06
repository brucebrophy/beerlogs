<?php

namespace App\Models\Beers;

use Illuminate\Database\Eloquent\Model;

class Yeast extends Model
{
    protected $guarded = [];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}
