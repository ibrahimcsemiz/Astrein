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
    public $model;

    public ServicePlan $servicePlan;

    public $showEditModal = false;

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('service_plans', 'name')->where(function ($query) {
                    return $query->where('hotel_id', $this->hotelId)
                        ->where('id', '!=', $this->servicePlan->id);
                })
            ]
        ];
    }


    public function destroy(ServicePlan $servicePlan)
    {
        $delete = $servicePlan->delete();

        if ($delete) {
            $this->notify('success', 'Success', 'The operation was successful.');
        } else {
            $this->notify('error', 'Error', 'An error occurred during the operation.');
        }
    }

    public function create(ServicePlan $servicePlan)
    {
        $this->servicePlan = $this->servicePlan ?? $servicePlan::make();

        $this->name = '';

        $this->model = 'store';

        $this->showEditModal = true;
    }

    public function store()
    {
        $this->validate();

        $insert = $this->servicePlan->create([
            'name' => $this->name,
            'hotel_id' => $this->hotelId
        ]);

        if ($insert) {
            $this->notify('success', 'Success', 'The operation was successful.');
        } else {
            $this->notify('error', 'Error', 'An error occurred during the operation.');
        }

        $this->showEditModal = false;
    }

    public function edit(ServicePlan $servicePlan)
    {
        $this->model = 'save';

        $this->servicePlan = $servicePlan;

        $this->name = $servicePlan->name;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();

        $update = $this->servicePlan->update([
            'name' => $this->name
        ]);

        if ($update) {
            $this->notify('success', 'Success', 'The operation was successful.');
        } else {
            $this->notify('error', 'Error', 'An error occurred during the operation.');
        }

        $this->showEditModal = false;
    }

    public function render()
    {
        $servicePlans = ServicePlan::where('hotel_id', $this->hotelId)->get();

        return view('livewire.service-plan-component', compact('servicePlans'));
    }
}
