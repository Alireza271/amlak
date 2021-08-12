<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poster_Daily_Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'description1',
        'description2',
        'poster_count',
        "created_at"
    ];
    protected $table='poster_daily_reports';
public $timestamps=false;
    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
