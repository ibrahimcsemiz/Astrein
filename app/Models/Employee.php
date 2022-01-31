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

    public function calculationMethods()
    {
        $i = 0;
        foreach ($this->hotel[0]->servicePlans as $servicePlan) {
            $calculationMethods[$i]['service_plan_name'] = $servicePlan->name;
            $calculationMethods[$i]['calculation_method_id'] = $servicePlan->calculationMethods[0]->pivot->id;
            $calculationMethods[$i]['calculation_method_name'] = $servicePlan->calculationMethods[0]->name;
            $i++;
        }

        return $calculationMethods ?? [];
    }
}
