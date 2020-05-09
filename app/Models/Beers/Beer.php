<?php

namespace App\Models\Beers;

use App\Models\User;
use App\Models\Beers\Recipe;
use App\Models\Beers\Style;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Beer extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'notes',
        'description',
        'style_id',
        'user_id',
    ];

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['user.username', 'name']
            ]
        ];
    }

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
