<?php

namespace App\Beers;

use App\Malts\Malt;
use App\Beers\Recipe;
use Illuminate\Database\Eloquent\Model;

class MaltAddition extends Model
{
    protected $guarded = [];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function malt()
    {
        return $this->belongsTo(Malt::class);
    }
}
