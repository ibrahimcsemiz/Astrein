<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'function',
        'status',
        'password',
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
