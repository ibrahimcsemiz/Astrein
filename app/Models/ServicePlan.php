<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hotel_id',
        'sunday_wage',
    ];

    public function calculationMethods()
    {
        return $this->belongsToMany(CalculationMethod::class, 'service_plan_calculation_method')
            ->withPivot('id', 'price', 'price_2', 'time', 'time_2')
            ->withTimestamps();
    }
}
