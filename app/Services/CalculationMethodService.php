<?php

namespace App\Services;

use App\Models\CalculationMethod;

class CalculationMethodService
{
    public function store($request)
    {
        return CalculationMethod::create([
            'name' => $request->name,
            'calculation_per_minute' => $request->calculation_per_minute,
            'editable' => $request->editable
        ]);
    }

    public function update($request, $calculationMethod)
    {
        return $calculationMethod->update([
            'name' => $request->name,
            'calculation_per_minute' => $request->calculation_per_minute,
            'editable' => $request->editable
        ]);
    }
}
