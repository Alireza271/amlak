<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estate extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function city()
    {
        return $this->belongsTo(\App\Models\City::class);
    }

    public function location()
    {
        return $this->belongsTo(\App\Models\Location::class);
    }

    public function estate_type()
    {
        return $this->belongsTo(\App\Models\estate_type::class);
    }

    public function building_type()
    {

        return $this->belongsTo(building_type::class);
    }

    public function used_type()
    {

        return $this->belongsToMany(Used_type::class, 'used_type_estates');
    }

    public function conditions_type()
    {

        return $this->belongsToMany(Conditions_type::class, 'conditions_types_estates');
    }

    public function documents()
    {

        return $this->belongsToMany(document::class, 'documents_estates');
    }

    public function options()
    {

        return $this->belongsToMany(Options::class, 'options_estates');
    }

    public function vila_options()
    {

        return $this->belongsToMany(vila_options::class, 'vila_options_estates');
    }

    public function images()
    {

        return $this->hasMany(Estate_Images::class);
    }

    public function estate_location_type()
    {

        return $this->belongsTo(Estate_Location_type::class);

    }

}
