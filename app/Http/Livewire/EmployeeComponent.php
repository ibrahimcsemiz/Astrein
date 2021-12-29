<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class EmployeeComponent extends Component
{

    public $hotelId;

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->hotel()->detach($this->hotelId);

            session()->flash('status', 'success');
            session()->flash('message', 'The operation was successful.');

        } else {
            session()->flash('status', 'error');
            session()->flash('message', 'An error occurred during the operation.');
        }
    }

    public function store($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->hotel()->attach($this->hotelId, [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $user->hotel()->syncWithoutDetaching([$this->hotelId]);

            session()->flash('status', 'success');
            session()->flash('message', 'The operation was successful.');
        } else {
            session()->flash('status', 'error');
            session()->flash('message', 'An error occurred during the operation.');
        }
    }

    public function render()
    {
        $employees = User::with('hotel')
            ->whereHas('hotel', function ($employees){
                $employees->where('hotel_id', $this->hotelId);
            })
            ->get();

        $employeeIds = $employees->pluck('id')->toArray();

        if ($this->search && strlen($this->search) >= 3) {

            $users = User::where('function', 'Employee')
                ->where('name', 'like', '%' . $this->search . '%')
                ->whereNotIn('id', $employeeIds)
                ->get();
        }

        return view('livewire.employee-component', [
            'id' => $this->hotelId,
            'employees' => $employees,
            'users' => $users ?? [],
        ]);
    }
}
