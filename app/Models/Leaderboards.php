<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leaderboards extends Model
{
    use Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $fillable = [
        'tournament_id',
        'game_id',
        'user_id',
        'reward_id',
        'score',
        'reward',
        'reward_name',
        'rank'
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getTournaments()
    {
        return $this->belongsTo(Tournaments::class, 'tournament_id', 'id');
    }

    public function getGame()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    public function getReward()
    {
        return $this->belongsTo(TournamentReward::class, 'reward_id', 'id');
    }
}
