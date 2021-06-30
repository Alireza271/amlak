<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Used_type extends Model
{
    use HasFactory;

    public function estate(){

        return $this->belongsToMany(estate::class,'used_type_estates');
    }

}
