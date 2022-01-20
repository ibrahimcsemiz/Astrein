<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class WorkersComponent extends Component
{
    public $hotelId;

    public $search = '';

    public User $user;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function store(User $user)
    {
        $attach = $user->hotel()->syncWithoutDetaching([$this->hotelId]);

        if ($attach['attached'] ?? false) {
            $this->notify('success', __('language.success'), __('language.success_message'));
        } else {
            $this->notify('error', __('language.error'), __('language.error_message'));
        }
    }

    public function destroy(User $user)
    {
        $detach = $user->hotel()->detach($this->hotelId);

        if ($detach) {
            $this->notify('success', __('language.success'), __('language.success_message'));
        } else {
            $this->notify('error', __('language.error'), __('language.error_message'));
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
        } else {
            $users = [];
        }

        return view('livewire.workers-component', compact($this->hotelId, 'employees', 'users'));
    }
}
