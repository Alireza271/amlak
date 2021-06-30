<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estate_Images extends Model
{
    protected $fillable = ['file_name'];
    use HasFactory;

    protected $table = 'estate_images';

    public function estate()
    {

        return $this->belongsTo(estate::class);
    }
}
