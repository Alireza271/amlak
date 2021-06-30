<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vila_options extends Model
{
    use HasFactory;
    public function estate(){

        return $this->belongsToMany(estate::class,'vila_options_estates');
    }
}
