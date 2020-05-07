<?php

namespace App\Models\Beers;

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

    public function malts()
    {
        return $this->belongsToMany(Malt::class);
    }

    public function hops()
    {
        return $this->belongsToMany(Hop::class);
    }

    public function yeasts()
    {
        return $this->belongsToMany(Yeast::class);
    }
}
