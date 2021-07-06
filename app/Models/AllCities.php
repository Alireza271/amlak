<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllCities extends Model
{
    use HasFactory;

    public function Posters()
    {
        return $this->hasMany(Poster::class);
    }

}
