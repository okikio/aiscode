<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivationLink extends Model
{
    protected $fillable = [
        'email', 'activation_link'
    ];
}
