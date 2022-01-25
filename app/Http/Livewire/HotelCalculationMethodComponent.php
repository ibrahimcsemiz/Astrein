<?php

namespace App\Http\Livewire;

use App\Models\CalculationMethod;
use App\Models\Hotel;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class HotelCalculationMethodComponent extends Component
{
    use WithPagination;

    public $hotelId;
    public $calculationMethodId;
    public $pivot;
    public $hourly_wage;
    public $model;

    public Hotel $hotel;
    public CalculationMethod $calculationMethod;

    public $showEditModal = false;

    public function rules()
    {
        return [
            'hourly_wage' => [
                'required',
                'numeric'
            ]
        ];
    }

    public function mount()
    {
        $this->hotel = Hotel::findOrFail($this->hotelId);
    }

    public function destroy(CalculationMethod $calculationMethod)
    {
        $detach = $this->hotel->calculationMethods()->detach($calculationMethod);

        if ($detach) {
            $this->notify('success', __('language.success'), __('language.success_message'));
        } else {
            $this->notify('error', __('language.error'), __('language.error_message'));
        }
    }

    public function create()
    {
        $this->model = 'store';

        $this->showEditModal = true;
    }

    public function store()
    {
        $this->validate();

        $attach = $this->hotel->calculationMethods()->syncWithoutDetaching($this->calculationMethodId);

        if ($attach['attached'] ?? false) {
            $this->hotel->calculationMethods()->updateExistingPivot($attach['attached'][0], [
                'hourly_wage' => Str::setPrice($this->hourly_wage),
            ]);

            $this->notify('success', __('language.success'), __('language.success_message'));
        } else {
            $this->notify('error', __('language.error'), __('language.error_message'));
        }

        $this->showEditModal = false;
    }

    public function edit(CalculationMethod $calculationMethod)
    {
        $this->model = 'save';

        $this->calculationMethod = $calculationMethod;

        $hotel = $this->hotel->calculationMethods()->wherePivot('calculation_method_id', $calculationMethod->id)->get();

        $this->hourly_wage = Str::getPrice($hotel[0]->pivot->hourly_wage);

        $this->pivot = $hotel[0]->pivot->id;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();

        $update = $this->hotel->calculationMethods()->wherePivot('calculation_method_id', $this->calculationMethod->id)->update([
            'hourly_wage' => Str::setPrice($this->hourly_wage),
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
        $hotelCalculationMethods = $this->hotel->calculationMethods()->get();

        if ($hotelCalculationMethods ?? false) {
            $hotelCalculationMethodIds = $hotelCalculationMethods->pluck('id')->toArray();
            $calculationMethods = CalculationMethod::whereNotIn('id', $hotelCalculationMethodIds)
                ->get();
        } else {
            $calculationMethods = CalculationMethod::all();
        }

        return view('livewire.hotel-calculation-method-component', compact('hotelCalculationMethods', 'calculationMethods'));
    }
}
