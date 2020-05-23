<?php

namespace App\Beers;

use App\Malts\Malt;
use App\System\Unit;
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

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
