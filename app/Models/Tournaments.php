<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tournaments extends Model
{
    use Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $fillable = [
        'game_id',
        'name',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'number_of_winner',
        'status',
        'session_time',
        'description',
        'category_id'
    ];

    public function getGame()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    public function getReward()
    {
        return $this->hasMany(TournamentReward::class, 'tournament_id', 'id');
    }
}
