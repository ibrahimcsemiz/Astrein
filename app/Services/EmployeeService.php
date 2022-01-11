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
                'birth_date' => $request->birth_date
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
                'function' => $request->function
            ]);

            $updateContactInformation = $employee->contact()->update([
                'telephone' => $request->telephone,
                'city' => $request->city,
                'address' => $request->address
            ]);

            $updatePersonalInformation = $employee->personal()->update([
                'birth_date' => $request->birth_date
            ]);

            if ($updateEmployee && $updateContactInformation && $updatePersonalInformation) {
                return true;
            } else {
                return false;
            }
        });
    }
}
