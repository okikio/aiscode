<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\SoftDeletes;

class TournamentReward extends Model
{
    use Notifiable;
    // use SoftDeletes;

    protected $guarded = [];

    protected $fillable = [
        'tournament_id',
        'winner_id',
        'rank',
        'reward_name',
        'reward',
        'reward_code',
        'description',
    ];
}