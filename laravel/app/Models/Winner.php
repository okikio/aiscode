<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Winner extends Model
{
    use SoftDeletes, Notifiable;

    protected $guarded = [];

    protected $fillable = [
        'rank',
        'reward_name',
        'reward',
        'description',
        'reward_code',
    ];
}
