<?php

namespace App\Models\Beers;
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
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
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
