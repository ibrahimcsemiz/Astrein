<?php

namespace App\Http\Livewire;

use App\Models\Hotel;
use Livewire\Component;
use Livewire\WithPagination;

class HotelComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';

    public $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1]
    ];

    public function updatingSearch()
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
        $hotels = Hotel::when($this->search, function ($hotels) {
                $hotels->where(function ($hotels) {
                    $hotels->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('telephone', 'like', '%' . $this->search . '%')
                        ->orWhere('city', 'like', '%' . $this->search . '%')
                        ->orWhereHas('foreman', function ($hotels) {
                            $hotels->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('manager', function ($hotels) {
                            $hotels->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('region', function ($hotels) {
                            $hotels->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->with('employees')
            ->with('manager')
            ->with('foreman')
            ->with('region')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(25);

        return view('livewire.hotel-component', [
            'hotels' => $hotels,
        ]);
    }
}
