<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;
    protected $table = 'products';

    protected $fillable = [
        'id','name','cat_id','subcat_id','amount','type','photos','price','offer','short_desc','long_desc',
        'how_used','price_delevery_free','end_date','status','created_at','updated_at',
    ];
    public $translatable = ['name', 'short_desc','long_desc','how_used'];

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
