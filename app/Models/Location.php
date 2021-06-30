<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    public function estate(){

        return $this->hasMany(estate::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
