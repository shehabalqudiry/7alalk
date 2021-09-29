<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicCat extends Model
{
    protected $table = 'clinic_cats';

    protected $guarded = [];

    public function clinics()
    {
        return $this->hasMany(Clinic::class, 'id');
    }
}
