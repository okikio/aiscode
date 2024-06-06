<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Uuid;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable,SoftDeletes;

    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'status',
        'birth_date',
        'affiliate_code',
        'phone_number',
        'nick_name',
        'country',
        'state',
        'address',
        'zipcode',
        'affiliate_id',
        'isActive',
        'provider',
        'provider_id',
        'image',
        'login_type',
        'ip_address',
        'linked_fb_id',
        'linked_google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function image(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value ? asset('storage/user/'.$value) : asset('adminassets/no-image.png'),
            set: fn ($value) => $value,
        );
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->affiliate_code =strtoupper(uniqid());
        });
    }

    public function getAffiliateAds()
    {
        return $this->belongsTo(AffiliateAds::class, 'affiliate_id', 'id');
    }

}
