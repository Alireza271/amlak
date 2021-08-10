<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class User extends Authenticatable implements FromCollection
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_attract',
        'is_circulation',
        'is_admin',
        'name',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function estate(){

        return $this->hasMany(estate::class);
    }
    public function Posters(){

        return $this->hasMany(Poster::class);
    }

    public function customersinfo()
    {
        return $this->hasMany(CustomerInfo::class);
    }

    public function collection()
    {
       return User::all();
    }
}
