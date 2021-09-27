<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordercheck extends Model
{
    protected $table = 'orders_check';

    protected $fillable = [
        'id','name','phone','num_account','animal_id','number','countery_id',
        'time','address','descibe','other_desc','user_id','lat','lang','created_at','updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function countery()
    {
        return $this->belongsTo('App\Models\Countery','countery_id','id');
    }

    public function animal()
    {
        return $this->belongsTo('App\Models\Animal','animal_id','id');
    }
}
