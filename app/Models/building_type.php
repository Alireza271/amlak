<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class building_type extends Model
{
    use HasFactory;
    public $fillable=['name'];
    public $timestamps=false;
    public function estate(){

        return $this->belongsToMany(estate::class,'estate_building_types');
    }
}
