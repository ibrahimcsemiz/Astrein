<?php

namespace App\Http\Livewire;

use App\Models\CalculationMethod;
use Livewire\Component;
use Livewire\WithPagination;

class CalculationMethodComponent extends Component
{
    use WithPagination;
    public $search;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $limit = 10;
    public $pageLength = [10, 25, 100];

    public CalculationMethod $calculationMethod;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1]
    ];

    public function updatingSearch()
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
        $calculationMethods = CalculationMethod::when($this->search, function ($calculationMethods) {
            $calculationMethods->where(function ($calculationMethods) {
                $calculationMethods->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        $calculationMethods = in_array($this->limit, $this->pageLength)
            ? $calculationMethods->paginate($this->limit)
            : $calculationMethods->paginate($calculationMethods->count());

        return view('livewire.calculation-method-component', compact('calculationMethods'));
    }
}
