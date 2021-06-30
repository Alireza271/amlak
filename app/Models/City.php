<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function estate()
    {

        return $this->hasMany(estate::class);
    }

    public function location()
    {

        return $this->hasMany(Location::class);
    }

    public function Posters()
    {
        return $this->hasMany(Poster::class);
    }
}
