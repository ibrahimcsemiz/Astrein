<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\EmployeeRequest;
use App\Services\EmployeeService;

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

    public function store(EmployeeRequest $request, EmployeeService $employeeService)
    {
        $insertEmployee = $employeeService->store($request);

        if ($insertEmployee) {
            return redirect()->back()->notify('success', __('language.success'), __('language.success_message'));
        } else {
            return redirect()->back()->notify('error', __('language.error'), __('language.error_message'));
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

    public function update(EmployeeRequest $request, Employee $employee, EmployeeService $employeeService)
    {
        $updateEmployee = $employeeService->update($request, $employee);

        if ($updateEmployee) {
            return redirect()->back()->notify('success', __('language.success'), __('language.success_message'));
        } else {
            return redirect()->back()->notify('error', __('language.error'), __('language.error_message'));
        }
    }


    public function destroy(Employee $employee)
    {
        $deleteEmployee = $employee->delete();

        if ($deleteEmployee) {
            return redirect()->route('employees')->notify('success', __('language.success'), __('language.success_message'));
        } else {
            return redirect()->back()->notify('error', __('language.error'), __('language.error_message'));
        }
    }
}
