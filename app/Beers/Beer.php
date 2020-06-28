<?php

namespace App\Beers;

use App\User;
use App\Comment;
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
        'is_private',
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
                'source' => ['name', 'user.username']
            ]
        ];
    }

	public function scopeBySearch($query, $term = '')
	{
		return $term ? $query->where('name', 'like', '%' . $term . '%') : $query;
    }

    public function scopePublic($query)
    {
        return $query->where('is_private', 0);
    }

    public function isPrivate()
    {
        return $this->is_private ? true : false;
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class)->latest();
    }

    public function style()
    {
        return $this->belongsTo(Style::class);
    }
}
