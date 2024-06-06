<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateAds extends Model
{

    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];
}
