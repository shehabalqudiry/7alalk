<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Animal extends Model
{
    use HasTranslations;

    protected $table = 'animals';
    
    protected $fillable = [
        'id','name','created_at','updated_at',
    ];
    
    public $translatable = ['name'];
}
