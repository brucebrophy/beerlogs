<?php

namespace App\Models\Beers;

use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'notes',
        'description',
        'style_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function style()
    {
        return $this->belongsTo(Style::class);
    }
}
