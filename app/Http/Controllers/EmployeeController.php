<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(EmployeeRequest $request)
    {
        $password = Str::random(8);

        $response = DB::transaction(function() use ($request, $password) {
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

        if ($response) {
            return redirect()->back()->with('status', 'success')->with('message', 'The operation was successful. <br><b>Password:</b> ' . $password);
        } else {
            return redirect()->back()->with('status', 'error')->with('message', 'An error occurred during the operation.');
        }
    }

    public function show(Employee $employee)
    {
        //
    }

    public function edit(Employee $employee)
    {
        $employee->load(['contact', 'personal']);

        return view('employees.edit', compact('employee'));
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $response = DB::transaction(function() use ($employee, $request) {

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

        if ($response) {
            return redirect()->back()->with('status', 'success')->with('message', 'The operation was successful.');
        } else {
            return redirect()->back()->with('status', 'error')->with('message', 'An error occurred during the operation.');
        }
    }


    public function destroy(Employee $employee)
    {
        $deleteUser = $employee->delete();

        if ($deleteUser) {
            return redirect(url('employees'))->with('status', 'success')->with('message', 'The operation was successful.');
        } else {
            return redirect()->back()->with('status', 'error')->with('message', 'An error occurred during the operation.');
        }
    }
}
