<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ClinicOrder extends Model
{
    use HasTranslations;
    protected $table = 'clinic_orders';

    protected $guarded = [];
    public $translatable = ['name'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
