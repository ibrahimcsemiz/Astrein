<?php

namespace App\Http\Livewire;

use App\Models\ServicePlan;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ServicePlanComponent extends Component
{
    use WithPagination;

    public $hotelId;
    public $name;
    public $servicePlan;
    public $model;

    public $showEditModal = false;

    public function destroy($id)
    {
        $this->servicePlan = ServicePlan::findOrFail($id);
        if ($this->servicePlan) {
            $this->servicePlan->delete();
        }
    }

    public function create()
    {
        $this->servicePlan = $this->servicePlan ?? ServicePlan::make();

        $this->name = '';

        $this->model = 'store';

        $this->showEditModal = true;
    }

    public function store()
    {
        $this->validate([
            'name' => [
                'required',
                Rule::unique('service_plans', 'name')->where(function ($query) {
                    return $query->where('hotel_id', $this->hotelId);
                })
            ]
        ]);

        $this->servicePlan->create([
            'name' => $this->name,
            'hotel_id' => $this->hotelId
        ]);

        $this->showEditModal = false;
    }

    public function edit($id)
    {
        $this->model = 'save';
        $this->servicePlan = ServicePlan::findOrFail($id);

        if ($this->servicePlan) {
            $this->name = $this->servicePlan->name;

            $this->showEditModal = true;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => [
                'required',
                Rule::unique('service_plans', 'name')->where(function ($query) {
                    return $query->where('hotel_id', $this->hotelId)
                        ->where('id', '!=', $this->servicePlan->id);
                })
            ]
        ]);

        $this->servicePlan->update([
            'name' => $this->name
        ]);

        $this->showEditModal = false;
    }

    public function render()
    {
        $servicePlans = ServicePlan::where('hotel_id', $this->hotelId)->get();

        return view('livewire.service-plan-component', [
            'servicePlans' => $servicePlans
        ]);
    }
}
