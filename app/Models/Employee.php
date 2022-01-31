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

    public function hotel()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_user', 'user_id', 'hotel_id')->withTimestamps();
    }

    public function contact()
    {
        return $this->hasOne(ContactInformation::class, 'user_id', 'id');
    }

    public function personal()
    {
        return $this->hasOne(PersonalInformation::class, 'user_id', 'id');
    }

    /*public function calculationMethods()
    {
        $s = 0;
        foreach ($this->hotel[0]->servicePlans ?? [] as $servicePlan) {
            $i = 0;
            $calculationMethods[] = [];
            foreach ($servicePlan->calculationMethods as $calculationMethod) {
                $calculationMethods[$s][$i]['service_plan_name'] = $servicePlan->name;
                $calculationMethods[$s][$i]['calculation_method_id'] = $calculationMethod->pivot->id;
                $calculationMethods[$s][$i]['calculation_method_name'] = $calculationMethod->name;
                $i++;
            }
            $s++;
        }

        $calculationMethods = ($calculationMethods ?? false) ? collect($calculationMethods)->flatten(1) : [];

        return $calculationMethods ?? [];
    }*/

    public function calculationMethods()
    {
        return CalculationMethod::all();
    }
}
