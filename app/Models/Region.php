<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany('App\User','user_id','id');
    }
}
