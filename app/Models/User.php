<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const FUNCTIONS = [
        'Foreman',
        'Manager',
        'Office',
        'Admin',
    ];

    protected $fillable = [
        'name',
        'email',
        'function',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function exists($id)
    {
        return self::where('id', $id)->count() > 0;
    }

    public function hotel()
    {
        return $this->belongsToMany(Hotel::class)->withTimestamps();
    }

    public function contact()
    {
        return $this->hasOne(ContactInformation::class);
    }

    public function personal()
    {
        return $this->hasOne(PersonalInformation::class);
    }
}
