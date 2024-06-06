<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $primaryKey = 'email';
    protected $table = 'password_reset_tokens';
    protected $fillable = [
        'email', 'token'
    ];
}
