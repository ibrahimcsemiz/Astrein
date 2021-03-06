<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'image',
    ];

    public function servicePlans()
    {
        return $this->hasMany(ServicePlan::class);
    }

    public function calculationMethods()
    {
        return $this->belongsToMany(CalculationMethod::class, 'hotel_calculation_method')
            ->withPivot('id', 'hourly_wage')
            ->withTimestamps();
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
