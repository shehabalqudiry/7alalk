<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Region extends Model
{
    use HasTranslations;
    protected $table = 'regions';

    protected $guarded = [];

    public $translatable = ['name'];

    public function users()
    {
        return $this->hasMany('App\User','user_id','id');
    }
}
