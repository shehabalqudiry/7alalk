<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CaseModel extends Model
{
    use HasTranslations;
    protected $table = 'cases';

    protected $guarded = [];

    public $translatable = ['name'];
}
