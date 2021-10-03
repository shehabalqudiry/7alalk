<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Cat extends Model
{
    use HasTranslations;
    
    protected $table = 'cats';

    protected $fillable = [
        'id','name','type','created_at','updated_at',
    ];
    public $translatable = ['name'];
}
