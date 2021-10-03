<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Offer extends Model
{
    use HasTranslations;
    protected $table = 'offers';

    protected $guarded = [];
    public $translatable = ['offer', 'desc'];
    public function products()
    {
        return $this->hasMany(Product::class, 'offer');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'offer_user', 'offer_id', 'user_id');
    }
}
