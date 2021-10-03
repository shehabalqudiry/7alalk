<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id','name','cat_id','subcat_id','amount','type','photos','price','offer','short_desc','long_desc',
        'how_used','price_delevery_free','end_date','status','created_at','updated_at',
    ];

    public function cat()
    {
        return $this->belongsTo('App\Models\Cat','cat_id','id');
    }

    public function subcat()
    {
        return $this->belongsTo('App\Models\Subcat','subcat_id','id');
    }

    public function userLike()
    {
        return $this->belongsToMany(User::class);
    }
}
