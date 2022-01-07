<?php

namespace App\Http\Livewire;

use App\Models\Hotel;
use App\Models\Region;
use Livewire\Component;
use Livewire\WithPagination;

class HotelComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $region = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $limit = 10;
    public $pageLength = [10, 25, 100];

    protected $queryString = [
        'search' => ['except' => ''],
        'region' => ['except' => ''],
        'page' => ['except' => 1]
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingRegion()
    {
        $this->resetPage();
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
        $hotels = Hotel::with('employees', 'manager', 'foreman', 'region', 'servicePlans')
            ->when($this->region, function ($hotels) {
                $hotels->whereHas('region', function ($hotels) {
                    $hotels->where('id', $this->region);
                });
            })
            ->when($this->search, function ($hotels) {
                $hotels->where(function ($hotels) {
                    $hotels->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('telephone', 'like', '%' . $this->search . '%')
                        ->orWhere('city', 'like', '%' . $this->search . '%')
                        ->orWhereHas('foreman', function ($hotels) {
                            $hotels->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('manager', function ($hotels) {
                            $hotels->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        $hotels = in_array($this->limit, $this->pageLength)
            ? $hotels->paginate($this->limit)
            : $hotels->paginate($hotels->count());

        $regions = Region::all();

        return view('livewire.hotel-component', compact('hotels', 'regions'));
    }
}
