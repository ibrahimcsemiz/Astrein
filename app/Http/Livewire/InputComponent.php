<?php

namespace App\Http\Livewire;

use App\Models\Hotel;
use App\Models\Input;
use Livewire\Component;

class InputComponent extends Component
{
    public $hotelId;
    public $servicePlanId;
    public $month;
    public $year;
    public $days;
    public $show = [];
    public $employees = [];
    public $values = [];

    public Hotel $hotel;

    public function mount()
    {
        $this->month = date('m');
        $this->year = date('Y');

        $this->days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);

        $this->hotel = Hotel::findOrFail($this->hotelId);

        $this->employees = $this->hotel->employees()->select('users.id', 'users.name')->get();

        $this->show['status'] = false;
        $this->show['text'] = __('language.show');
    }

    public function show()
    {
        $this->show['status'] = !$this->show['status'];
        $this->show['text'] = $this->show['status'] ? __('language.hide') : __('language.show');
    }

    public function updatedMonth()
    {
        $this->month = empty($this->month)
            ? date('m')
            : $this->month;

        $this->days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
    }

    public function updatedYear()
    {
        $this->year = empty($this->year)
            ? date('Y')
            : $this->year;

        $this->days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
    }

    public function updatedServicePlanId()
    {
        $this->days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);

        foreach ($this->getInputs() as $val) {
            $this->values[$val->input_key] = [$val->value, $val->value_2];
        }
    }

    public function getInputs()
    {
        return Input::select('value', 'value_2', 'input_key')
            ->where('service_plan_id', $this->servicePlanId)
            ->get();
    }

    public function storeInputs($key, $type, $value)
    {
        $spl = explode(':', $key);
        $employee = $spl[0];
        $day = $spl[2];

        Input::updateOrCreate([
            'user_id' => $employee,
            'service_plan_id' => $this->servicePlanId,
            'day' => $day,
            'input_key' => $key
        ], [
            $type => $value ?? 0,
        ]);
    }

    public function render()
    {
        $servicePlans = $this->hotel->servicePlans()->select('service_plans.id', 'service_plans.name')->get();
        $employees = $this->employees;

        return view('livewire.input-component', compact('servicePlans', 'employees'));
    }
}
