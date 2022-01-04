<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class WorkersComponent extends Component
{
    public $hotelId;

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function store($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->hotel()->syncWithoutDetaching([$this->hotelId]);
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->hotel()->detach($this->hotelId);
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

        return view('livewire.workers-component', [
            'hotelId' => $this->hotelId,
            'employees' => $employees,
            'users' => $users ?? [],
        ]);
    }
}
