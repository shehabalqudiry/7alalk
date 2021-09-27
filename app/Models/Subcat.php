<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcat extends Model
{
    protected $table = 'subcats';

    protected $fillable = [
        'id','photo','name','cat_id','created_at','updated_at',
    ];

    public function cat()
    {
        return $this->belongsTo('App\Models\Cat','cat_id','id');
    }
}
