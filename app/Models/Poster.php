<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $guarded = [];


    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function social()
    {

        return $this->belongsTo(Social::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function estate_type()
    {
        return $this->belongsTo(estate_type::class);
    }

    public function estate_location_type()
    {
        return $this->belongsTo(Estate_Location_type::class);
    }

    use HasFactory;
}
