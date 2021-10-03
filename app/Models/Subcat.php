<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subcat extends Model
{
    use HasTranslations;
    protected $table = 'subcats';

    protected $fillable = [
        'id','photo','name','cat_id','created_at','updated_at',
    ];
    public $translatable = ['name'];

    public function cat()
    {
        return $this->belongsTo('App\Models\Cat','cat_id','id');
    }
}
