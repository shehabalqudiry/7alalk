<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicOrder extends Model
{
    protected $table = 'clinic_orders';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
