<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];


    public function ads()
    {
        return $this->hasMany(\App\Models\Ad::class);
    }

    public function recent_ads()
    {
        return $this->hasMany(\App\Models\Ad::class)->latest()->take(3);
    }
}
