<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $table = 'cats';

    protected $fillable = [
        'id','name','type','created_at','updated_at',
    ];
}
