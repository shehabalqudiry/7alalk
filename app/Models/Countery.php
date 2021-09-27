<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countery extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'id','name','photo','created_at','updated_at',
    ];
}
