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
        $idles = User::orderByDesc('created_at')
            ->where('function', 'Employee')
            ->when($this->search, function ($users) {
                $users->where(function ($users) {
                    $users->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhereHas('contact', function ($users) {
                            $users->where('telephone', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('contact', function ($users) {
                            $users->where('city', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->with('hotel')
            ->with('contact')
            ->get();

        $employees = User::with('hotel')
            ->whereHas('hotel', function ($users){
                $users->where('hotel_id', $this->hotelId);
            })
            ->with('hotel')
            ->with('contact')
            ->get();

        $users = $employees->merge($idles)->paginate(25);

        return view('livewire.employee-component', [
            'id' => $this->hotelId,
            'idles' => $users
        ]);
    }
}
