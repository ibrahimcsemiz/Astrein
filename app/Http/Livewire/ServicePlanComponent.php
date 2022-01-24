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
    public $servicePlanId;
    public $name;
    public $sunday_wage;
    public $model;
    public $showMethods = false;

    public ServicePlan $servicePlan;

    public $showEditModal = false;

    protected $listeners = ['closeModal' => 'closeMethods'];

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('service_plans', 'name')->where(function ($query) {
                    return $query->where('hotel_id', $this->hotelId)
                        ->where('id', '!=', $this->servicePlan->id);
                })
            ],
            'sunday_wage' => [
                'required',
                'numeric'
            ]
        ];
    }

    public function closeMethods()
    {
        $this->showMethods = false;
    }

    public function methods($id)
    {
        $this->servicePlanId = $id;
        $this->showMethods = true;
    }


    public function destroy(ServicePlan $servicePlan)
    {
        $delete = $servicePlan->delete();

        if ($delete) {
            $this->notify('success', __('language.success'), __('language.success_message'));
        } else {
            $this->notify('error', __('language.error'), __('language.error_message'));
        }
    }

    public function create(ServicePlan $servicePlan)
    {
        $this->servicePlan = $this->servicePlan ?? $servicePlan::make();

        $this->name = '';
        $this->sunday_wage = '';

        $this->model = 'store';

        $this->showEditModal = true;
    }

    public function store()
    {
        $this->validate();

        $insert = $this->servicePlan->create([
            'name' => $this->name,
            'sunday_wage' => $this->sunday_wage * 100,
            'hotel_id' => $this->hotelId
        ]);

        if ($insert) {
            $this->notify('success', __('language.success'), __('language.success_message'));
        } else {
            $this->notify('error', __('language.error'), __('language.error_message'));
        }

        $this->showEditModal = false;
    }

    public function edit(ServicePlan $servicePlan)
    {
        $this->model = 'save';

        $this->servicePlan = $servicePlan;

        $this->name = $servicePlan->name;
        $this->sunday_wage = $servicePlan->sunday_wage / 100;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();

        $update = $this->servicePlan->update([
            'name' => $this->name,
            'sunday_wage' => $this->sunday_wage * 100,
        ]);

        if ($update) {
            $this->notify('success', __('language.success'), __('language.success_message'));
        } else {
            $this->notify('error', __('language.error'), __('language.error_message'));
        }

        $this->showEditModal = false;
    }

    public function render()
    {
        $servicePlans = ServicePlan::where('hotel_id', $this->hotelId)->get();

        return view('livewire.service-plan-component', compact('servicePlans'));
    }
}
