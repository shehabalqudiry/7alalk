<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $table = 'clinics';

    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function cat()
    {
        return $this->belongsTo(ClinicCat::class, 'clinic_cat_id');
    }
}
