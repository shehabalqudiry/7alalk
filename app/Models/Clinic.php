<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Clinic extends Model
{
    use HasTranslations;
    protected $table = 'clinics';

    protected $guarded = [];

    public $translatable = ['name', 'short_desc', 'lang_desc'];
    
    public function images()
    {
        return $this->hasMany(Image::class, 'clinic_id', 'id');
    }

    public function cat()
    {
        return $this->belongsTo(ClinicCat::class, 'clinic_cat_id');
    }
}
