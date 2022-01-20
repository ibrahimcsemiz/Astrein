<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculationMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'calculation_per_minute',
        'editable'
    ];

    public function hotel()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_calculation_method')
            ->withPivot('id', 'hourly_wage')
            ->withTimestamps();
    }
}
