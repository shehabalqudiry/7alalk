<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderFaq extends Model
{
    protected $table = 'orders_faq';

    protected $fillable = [
        'id','question','user_id','created_at','updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
