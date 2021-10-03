<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class, 'offer');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
