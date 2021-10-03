<?php

namespace App;

use App\Models\Countery;
use App\Models\Offer;
use App\Models\Region;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    ///////////////////////////////////Realtions
    public function reg() //Chang Name Conflict with region column in users table
    {
        return $this->belongsTo(Region::class, 'region', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Countery::class, 'countery', 'id');
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'offer_user', 'user_id', 'offer_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'favorites');
    }

    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'favorites', 'user_id', 'product_id');
    }
}
