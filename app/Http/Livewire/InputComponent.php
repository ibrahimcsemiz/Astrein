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
    public $inputs = [];

    public Hotel $hotel;

    public function mount()
    {
        $this->month = date('m');
        $this->year = date('Y');

        $this->days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);

        $this->hotel = Hotel::findOrFail($this->hotelId);
    }

    public function createInputs()
    {
        $employees = $this->hotel->employees()->get()->pluck('id')->toArray();

        foreach ($employees as $employee) {
            foreach(range(1, $this->days) as $day) {
                $day = str_pad($day, 2, "0", STR_PAD_LEFT);

                $this->inputs[$employee . '_' . $this->servicePlanId . '_' . $this->year . '-' . $this->month . '-' . $day]['value'] = $this->getInputValue($employee . '_' . $this->servicePlanId . '_' . $this->year . '-' . $this->month . '-' . $day)['value'];
                $this->inputs[$employee . '_' . $this->servicePlanId . '_' . $this->year . '-' . $this->month . '-' . $day]['value_2'] = $this->getInputValue($employee . '_' . $this->servicePlanId . '_' . $this->year . '-' . $this->month . '-' . $day)['value_2'];
            }
        }
    }

    public function updatedMonth()
    {
        $this->days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);

        $this->createInputs();
    }

    public function updatedYear()
    {
        $this->days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);

        $this->createInputs();
    }

    public function updatedServicePlanId()
    {
        $this->days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);

        $this->createInputs();
    }

    public function getInputValue($key)
    {
        $spl = explode('_', $key);
        $employee = $spl[0];

        $day = $spl[2];

        $input = Input::where('user_id', $employee)
            ->where('service_plan_id', $this->servicePlanId)
            ->where('day', $day)
            ->get();

        return [
            'value' => $input[0]->value ?? 0,
            'value_2' => $input[0]->value_2 ?? 0,
        ];
    }

    public function storeInputs($employee, $day, $type)
    {
        Input::updateOrCreate([
            'user_id' => $employee,
            'service_plan_id' => $this->servicePlanId,
            'day' => $day,
        ], [
            $type => $this->inputs[$employee . '_' . $this->servicePlanId . '_' . $day][$type] ?? 0,
        ]);
    }

    public function render()
    {
        $servicePlans = $this->hotel->servicePlans()->get();
        $employees = $this->hotel->employees()->get();

        return view('livewire.input-component', compact('servicePlans', 'employees'));
    }
}
