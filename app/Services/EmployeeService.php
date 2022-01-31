<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeService
{
    public function store($request)
    {
        $password = Str::random(8);

        return DB::transaction(function() use ($request, $password) {
            $insertEmployee = Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'function' => 'Employee',
                'password' => Hash::make($password)
            ]);

            $insertContactInformation = $insertEmployee->contact()->create([
                'telephone' => $request->telephone,
                'city' => $request->city,
                'address' => $request->address
            ]);

            $insertPersonalInformation = $insertEmployee->personal()->create([
                'birth_date' => $request->birth_date,
                'calculation_method_id' => $request->calculation_method_id,
            ]);

            if ($insertEmployee && $insertContactInformation && $insertPersonalInformation) {
                return true;
            } else {
                return false;
            }
        });
    }

    public function update($request, $employee)
    {
        return DB::transaction(function() use ($employee, $request) {
            $updateEmployee = $employee->update([
                'name' => $request->name,
                'email' => $request->email,
                'function' => 'Employee'
            ]);

            $updateContactInformation = $employee->contact()->updateOrCreate([
                'user_id' => $employee->id
            ], [
                'telephone' => $request->telephone,
                'city' => $request->city,
                'address' => $request->address
            ]);

            $updatePersonalInformation = $employee->personal()->updateOrCreate([
                'user_id' => $employee->id
            ], [
                'birth_date' => $request->birth_date,
                'calculation_method_id' => $request->calculation_method_id,
            ]);

            if ($updateEmployee && $updateContactInformation && $updatePersonalInformation) {
                return true;
            } else {
                return false;
            }
        });
    }
}
