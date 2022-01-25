<?php

namespace App\Http\Livewire;

use App\Models\CalculationMethod;
use App\Models\Hotel;
use App\Models\ServicePlan;
use Illuminate\Support\Str;
use Livewire\Component;

class ServicePlanCalculationMethodComponent extends Component
{
    public $hotelId;
    public $servicePlanId;
    public $calculationMethodId;
    public $price;
    public $price2;
    public $time;
    public $time2;
    public $max;
    public $hourly_wage;
    public $method;
    public $model = 'store';

    public ServicePlan $servicePlan;
    public Hotel $hotel;

    public $showModal = true;

    public function rules()
    {
        return [
            'price' => [
                'required',
                'numeric'
            ],
            'time' => [
                'required',
            ],
        ];
    }

    public function mount()
    {
        $this->servicePlan = ServicePlan::findOrFail($this->servicePlanId);
        $this->hotel = Hotel::findOrFail($this->hotelId);
    }

    public function timeConvert($time)
    {
        $split = explode(':', $time);
        return ($split[0] * 60) + ($split[1]) + ($split[2] > 30 ? 1 : 0);
    }

    public function updatedCalculationMethodId()
    {
        if (!empty($this->calculationMethodId)) {
            $pivot = $this->hotel->calculationMethods()->wherePivot('calculation_method_id', $this->calculationMethodId)->get();

            $this->hourly_wage =  Str::getPrice($pivot[0]->pivot->hourly_wage);
            $this->max = $this->hourly_wage;
            $this->method = $pivot[0]->name;

            if ($this->model == 'save') {
                $this->price = '';
                $this->price2 = '';
                $this->time = '';
                $this->time2 = '';

                $this->model = 'store';
            }
        }
    }

    public function updatedPrice()
    {
        if (isset($this->calculationMethodId)) {
            if (!empty($this->price)) {
                if ($this->price <= $this->hourly_wage) {
                    $this->time = (60 * $this->price) / $this->hourly_wage;
                    $this->time = $this->time * 60; // min to seconds
                    $this->time = gmdate('H:i:s', $this->time);
                } else {
                    $this->time = gmdate('01:00:00');
                }
            } else {
                $this->time = '';
            }
        }
    }

    public function updatedTime()
    {
        if (isset($this->calculationMethodId)) {
            if (!empty($this->time)) {
                if ($this->timeConvert($this->time) <= 60) {
                    $this->price = ($this->timeConvert($this->time)  * $this->hourly_wage) / 60;
                    $this->price = number_format($this->price, 2);
                } else {
                    $this->price = $this->hourly_wage;
                }
            } else {
                $this->price = '';
            }
        }
    }

    public function updatedPrice2()
    {
        if (isset($this->calculationMethodId)) {
            if (!empty($this->price2)) {
                if ($this->price2 <= $this->hourly_wage) {
                    $this->time2 = (60 * $this->price2) / $this->hourly_wage;
                    $this->time2 = $this->time2 * 60; // min to seconds
                    $this->time2 = gmdate('H:i:s', $this->time2);
                } else {
                    $this->time2 = gmdate('01:00:00');
                }
            } else {
                $this->time2 = '';
            }
        }
    }

    public function updatedTime2()
    {
        if (isset($this->calculationMethodId)) {
            if (!empty($this->time2)) {
                if ($this->timeConvert($this->time2) <= 60) {
                    $this->price2 = ($this->timeConvert($this->time2)  * $this->hourly_wage) / 60;
                    $this->price2 = number_format($this->price2, 2);
                } else {
                    $this->price2 = $this->hourly_wage;
                }
            } else {
                $this->price2 = '';
            }
        }
    }

    public function destroy(CalculationMethod $calculationMethod)
    {
        $detach = $this->servicePlan->calculationMethods()->detach($calculationMethod);

        if ($detach) {
            $this->notify('success', __('language.success'), __('language.success_message'));
        } else {
            $this->notify('error', __('language.error'), __('language.error_message'));
        }
    }

    public function edit($id)
    {
        $this->calculationMethodId = $id;

        $this->updatedCalculationMethodId();

        $this->model = 'save';

        $pivot = $this->servicePlan->calculationMethods()->wherePivot('calculation_method_id', $id)->get();

        $this->price = Str::getPrice($pivot[0]->pivot->price);

        $this->time = $pivot[0]->pivot->time;

        $this->price2 = Str::getPrice($pivot[0]->pivot->price_2);

        $this->time2 = $pivot[0]->pivot->time_2;
    }

    public function save()
    {
        $this->validate();

        $update = $this->servicePlan->calculationMethods()->wherePivot('calculation_method_id', $this->calculationMethodId)->update([
            'price' => Str::setPrice($this->price),
            'time' => $this->time,
            'price_2' => Str::setPrice($this->price2) ?? 0,
            'time_2' => $this->time2 ?? '00:00:00',
        ]);


        if ($update) {
            $this->notify('success', __('language.success'), __('language.success_message'));
        } else {
            $this->notify('error', __('language.error'), __('language.error_message'));
        }
    }

    public function store()
    {
        $this->validate();

        $attach = $this->servicePlan->calculationMethods()->syncWithoutDetaching($this->calculationMethodId);

        if ($attach['attached'] ?? false) {
            $this->servicePlan->calculationMethods()->updateExistingPivot($attach['attached'][0], [
                'price' => Str::setPrice($this->price),
                'time' => $this->time,
                'price_2' => Str::setPrice($this->price2) ?? 0,
                'time_2' => $this->time2 ?? '00:00:00',
            ]);

            $this->notify('success', __('language.success'), __('language.success_message'));
        } else {
            $this->notify('error', __('language.error'), __('language.error_message'));
        }
    }

    public function availableMethods($ids = [])
    {
        if (isset($ids)) {
            return $this->hotel->calculationMethods()->get()->whereNotIn('id', $ids);
        }
        return $this->hotel->calculationMethods()->get();
    }

    public function selectedMethods()
    {
        return $this->servicePlan->calculationMethods()->get();
    }

    public function render()
    {
        $selectedMethods = $this->selectedMethods() ?? [];

        if ($selectedMethods ?? false) {
            $selectedMethodIds = $selectedMethods->pluck('id')->toArray();
            $availableMethods = $this->availableMethods($selectedMethodIds);
        } else {
            $availableMethods = $this->availableMethods() ?? [];
        }

        return view('livewire.service-plan-calculation-method-component', compact('availableMethods', 'selectedMethods'));
    }
}
