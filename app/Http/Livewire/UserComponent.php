<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $function = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';

    protected $queryString = [
        'search' => ['except' => ''],
        'function' => ['except' => ''],
        'page' => ['except' => 1]
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFunction()
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
        $users = User::when($this->function, function ($users) {
            $users->where('function', '=', $this->function);
        })
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
            ->with('contact')
            ->with('personal')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(25);

        return view('livewire.user-component', [
            'users' => $users,
        ]);
    }
}
