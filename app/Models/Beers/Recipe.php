<?php

namespace App\Models\Beers;

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
}
