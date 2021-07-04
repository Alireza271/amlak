<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    protected $guarded = [];
    use HasFactory;


    public function estate_type(){

        return $this->belongsTo(estate_type::class);
    }
    public function user(){

        return $this->belongsTo(User::class);
    }
}
