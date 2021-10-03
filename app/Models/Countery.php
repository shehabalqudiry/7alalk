<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Countery extends Model
{
    use HasTranslations;
    protected $table = 'countries';

    protected $fillable = [
        'id','name','photo', 'created_at','updated_at',
    ];
    public $translatable = ['name'];
    public function users()
    {
        return $this->hasMany(User::class, 'countery', 'id');
    }

}
