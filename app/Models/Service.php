<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasTranslations;
    protected $table = 'services';

    protected $guarded = [];

    public $translatable = ['name', 'desc'];
    
}
