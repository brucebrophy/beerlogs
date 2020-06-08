<?php

namespace App\Beers;

use App\Hops\Hop;
use App\Malts\Malt;
use App\Beers\Beer;
use App\System\Unit;
use App\Yeasts\Yeast;
use App\Beers\HopAddition;
use App\Beers\MaltAddition;
use App\Beers\YeastAddition;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'uuid',
        'instructions',
        'abv',
        'ibu',
        'og',
        'fg',
        'srm',
        'batch_size',
        'adjuncts',
        'unit_id',
        'user_id',
        'beer_id',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected static function booted()
    {
        static::creating(function ($recipe) {
            $recipe->uuid = (string) \Str::uuid();
        });
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

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
