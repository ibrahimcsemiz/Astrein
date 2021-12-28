<?php

namespace App\Http\Livewire;

use App\Models\Hotel;
use App\Models\HotelUser;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeComponent extends Component
{
    use WithPagination;

    public $hotelId;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->hotel()->detach($this->hotelId);

            $this->resetPage();

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
