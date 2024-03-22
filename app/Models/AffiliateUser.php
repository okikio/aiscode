<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateUser extends Model
{
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'affiliate_id',
        'user_id',
        'amount'
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
