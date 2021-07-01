<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estate_type extends Model
{


    public function estate()
    {

        return $this->hasMany(estate::class);
    }

    public function posters()
    {

        return $this->hasMany(Poster::class);
    }


    public function customer_info()
    {
        return $this->hasMany(CustomerInfo::class);
    }
}
