<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StartGame extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $fillable = [
        'tournament_id',
        'user_id',
    ];
}