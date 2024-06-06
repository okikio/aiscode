<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use Notifiable, SoftDeletes, HasSlug;
    
    protected $guarded = [];

    protected $fillable = [
        'name',
        'status',
        'order'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getGame()
    {
        return $this->hasMany(Game::class, 'category_id', 'id');
    }
    
    public function getTournaments()
    {
        return $this->hasMany(Tournaments::class, 'category_id', 'id');
    }
}
