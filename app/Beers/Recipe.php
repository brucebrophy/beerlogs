<?php

namespace App\Beers;

use App\Hops\Hop;
use App\Malts\Malt;
use App\Beers\Beer;
use App\Yeasts\Yeast;
use App\Beers\HopAddition;
use App\Beers\MaltAddition;
use App\Beers\YeastAddition;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'instructions',
        'abv',
        'ibu',
        'og',
        'fg',
        'adjuncts',
        'beer_id',
    ];

    protected $casts = [
        'instructions' => 'object'
    ];

    public function beer()
    {
        return $this->belongsTo(Beer::class);
    }

    public function malt_additions()
    {
        return $this->hasMany(MaltAddition::class);
    }

    public function hop_additions()
    {
        return $this->hasMany(HopAddition::class);
    }

    public function yeast_additions()
    {
        return $this->hasMany(YeastAddition::class);
    }
}
