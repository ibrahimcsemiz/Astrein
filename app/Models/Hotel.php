<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'telephone',
        'region_id',
        'city',
        'address',
        'foreman_id',
        'manager_id',
    ];

    public static function exists($id)
    {
        return self::where('id', $id)->count() > 0;
    }

    public function employees()
    {
        return $this->belongsToMany(User::class);
    }

    public function manager()
    {
        return $this->hasOne(User::class, 'id', 'manager_id');
    }

    public function foreman()
    {
        return $this->hasOne(User::class, 'id', 'foreman_id');
    }

    public function region()
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }
}
