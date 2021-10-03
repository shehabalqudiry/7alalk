<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ClinicCat extends Model
{
    use HasTranslations;
    protected $table = 'clinic_cats';

    protected $guarded = [];
    
    public $translatable = ['name'];

    public function clinics()
    {
        return $this->hasMany(Clinic::class, 'clinic_cat_id', 'id');
    }
}
