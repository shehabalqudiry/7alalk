<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Countery extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'id','name','photo', 'currency','created_at','updated_at',
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'countery', 'id');
    }

}
