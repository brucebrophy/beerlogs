<?php

namespace App\Beers;

use App\Beers\Recipe;
use App\Yeasts\Yeast;
use Illuminate\Database\Eloquent\Model;

class YeastAddition extends Model
{
    protected $guarded = [];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function yeast()
    {
        return $this->belongsTo(Yeast::class);
    }
}
