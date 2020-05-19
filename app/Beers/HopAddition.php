<?php

namespace App\Beers;

use App\Hops\Hop;
use App\System\Unit;
use App\Hops\HopType;
use App\Beers\Recipe;
use Illuminate\Database\Eloquent\Model;

class HopAddition extends Model
{
    protected $fillable = [
        'hop_id',
        'recipe_id',
        'hop_type_id',
        'unit_id',
        'amount',
        'minute',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function hop()
    {
        return $this->belongsTo(Hop::class);
    }

    public function type()
    {
        return $this->belongsTo(HopType::class, 'hop_type_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
