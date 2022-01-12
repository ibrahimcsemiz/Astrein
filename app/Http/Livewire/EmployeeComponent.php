<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeComponent extends Component
{
    use WithPagination;

    public $search;
    public $status;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $limit = 10;
    public $pageLength = [10, 25, 100];

    public Employee $employee;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1]
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updateStatus(Employee $employee)
    {
        $employee->status = $employee->status == 1 ? 0 : 1;
        $update = $employee->save();

        if ($update) {
            $this->notify('success', __('language.success'), __('language.success_message'));
        } else {
            $this->notify('error', __('language.error'), __('language.error_message'));
        }

    }

    public function updatingLimit()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sortField = $field;
    }

    public function render()
    {
        $employees = Employee::with('contact', 'hotel')
            ->where('function', 'Employee')
            ->when(is_numeric($this->status), function ($employees) {
                $employees->where('status', '=', $this->status);
            })
            ->when($this->search, function ($employees) {
                $employees->where(function ($employees) {
                    $employees->where('name', 'like', '%' . $this->search . '%')
                        ->orWhereHas('contact', function ($employees) {
                            $employees->where('telephone', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('hotel', function ($employees) {
                            $employees->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        $employees = in_array($this->limit, $this->pageLength)
            ? $employees->paginate($this->limit)
            : $employees->paginate($employees->count());

        return view('livewire.employee-component', compact('employees'));
    }
}
