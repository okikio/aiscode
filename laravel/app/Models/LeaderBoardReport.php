<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaderBoardReport extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'leaderboard_id',
        'user_id',
        'score',
    ];
}
