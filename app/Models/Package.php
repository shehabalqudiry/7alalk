<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Package extends Model
{
    use HasTranslations;
    protected $table = 'packages';

    protected $guarded = [];

    public $translatable = ['name', 'desc'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
