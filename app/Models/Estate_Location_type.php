<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estate_Location_type extends Model
{

    protected $table="estate_location_types";
    use HasFactory;


    public function estate()
    {
        return $this->hasMany(estate::class);
    }
    public function posters()
    {
        return $this->hasMany(Poster::class);
    }
}
