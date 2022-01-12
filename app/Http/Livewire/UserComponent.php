<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;

    public $search;
    public $function;
    public $status;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $limit = 10;
    public $pageLength = [10, 25, 100];

    public User $user;

    protected $queryString = [
        'search' => ['except' => ''],
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

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingLimit()
    {
        $this->resetPage();
    }

    public function updateStatus(User $user)
    {
        $user->status = $user->status == 1 ? 0 : 1;
        $update = $user->save();

        if ($update) {
            $this->notify('success', __('language.success'), __('language.success_message'));
        } else {
            $this->notify('error', __('language.error'), __('language.error_message'));
        }
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
        $users = User::with('contact', 'hotel')
            ->where('function', '!=', 'Employee')
            ->when($this->function, function ($users) {
                $users->where('function', '=', $this->function);
            })
            ->when(is_numeric($this->status), function ($users) {
                $users->where('status', '=', $this->status);
            })
            ->when($this->search, function ($users) {
                $users->where(function ($users) {
                    $users->where('name', 'like', '%' . $this->search . '%')
                        ->orWhereHas('contact', function ($users) {
                            $users->where('telephone', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('hotel', function ($users) {
                            $users->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        $users = in_array($this->limit, $this->pageLength)
            ? $users->paginate($this->limit)
            : $users->paginate($users->count());

        return view('livewire.user-component', compact('users'));
    }
}
