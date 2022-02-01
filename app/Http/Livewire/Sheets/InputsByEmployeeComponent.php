<?php

namespace App\Http\Livewire\Sheets;

use App\Models\Employee;
use App\Models\Hotel;
use App\Models\Input;
use App\Models\ServicePlan;
use Livewire\Component;

class InputsByEmployeeComponent extends Component
{
    public $month;
    public $year;
    public $days;

    public $employees = [];
    public $values = [];
    public $rows = [];
    public $servicePlans = [];
    public $calculationMethods = [];

    public $hotelId;
    public $employeeId;

    public Hotel $hotel;
    public Employee $employee;

    public $listeners = ['$refresh'];

    public function mount()
    {
        $this->month = date('m');
        $this->year = date('Y');

        $this->days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
    }

    public function updatedMonth()
    {
        $this->month = empty($this->month)
            ? date('m')
            : $this->month;

        $this->days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);

        $this->updatedEmployeeId();
    }

    public function updatedYear()
    {
        $this->year = empty($this->year)
            ? date('Y')
            : $this->year;

        $this->days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);

        $this->updatedEmployeeId();
    }

    public function updatedHotelId()
    {
        if (!empty($this->hotelId)) {
            $this->hotel = Hotel::find($this->hotelId);

            $this->employees = $this->hotel->employees()->get();

            $this->servicePlans = $this->hotel->servicePlans()->get();

            $this->employeeId = '';
        }
    }

    public function updatedEmployeeId()
    {
        foreach ($this->getInputs() as $val) {
            $this->values[$val->input_key] = [
                'value' => $val->value,
                'hour' => $this->calculator($val->value, $val->service_plan_id, $val->calculation_method_id)
            ];
        }

        $this->rows = $this->totalValues();
    }

    public function totalValues()
    {
        for ($i = 1; $i <= $this->days; $i++) {
            $date = date('Y-m-d', strtotime(date($this->year . '-' . $this->month . '-' . $i)));

            $totalValues[$i]['date'] = $date;

            foreach ($this->servicePlans as $servicePlan) {
                $inputKey = $this->employeeId . ':' . $servicePlan->id . ':' . $date;

                $totalValues[$i]['sheet'][$inputKey]['value'] = $this->values[$inputKey]['value'] ?? 0;

                $totalValues[$i]['sheet'][$inputKey]['hour'] = $this->values[$inputKey]['hour'] ?? 0;

                $timeSum[] = $totalValues[$i]['sheet'][$inputKey]['hour'];
            }

            $totalValues[$i]['time'] = array_sum($timeSum);

            $totalTimeSum[] = $totalValues[$i]['time'];

            unset($timeSum);
        }

        $totalValues['total_time'] = array_sum($totalTimeSum);

        return $totalValues;
    }

    public function timeConvert($time)
    {
        $split = explode(':', $time);
        return ($split[0] * 60) + ($split[1]) + ($split[2] > 30 ? 1 : 0);
    }

    public function calculator($value, $servicePlanId, $calculationMethodId)
    {
        $calculationMethod = ServicePlan::find($servicePlanId)
            ->calculationMethods()
            ->wherePivot('calculation_method_id', $calculationMethodId)
            ->get();

        $time = $calculationMethod[0]->pivot->time;
        return $this->timeConvert($time) * $value;
    }

    public function getInputs()
    {
        return Input::where('user_id', $this->employeeId)->get();
    }

    public function render()
    {
        $hotels = Hotel::all();

        return view('livewire.sheets.inputs-by-employee-component', compact('hotels'));
    }
}
