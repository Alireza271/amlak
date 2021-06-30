<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{

    public function Posters()
    {
        return $this->hasMany(Poster::class);
    }

    use HasFactory;
}
