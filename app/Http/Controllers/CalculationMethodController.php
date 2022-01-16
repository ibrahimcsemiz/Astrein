<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculationMethodRequest;
use App\Models\CalculationMethod;
use App\Services\CalculationMethodService;

class CalculationMethodController extends Controller
{
    public function index()
    {
        return view('calculation-methods.index');
    }

    public function create()
    {
        return view('calculation-methods.create');
    }

    public function store(CalculationMethodRequest $request, CalculationMethodService $calculationMethodService)
    {
        $insertCalculationMethod = $calculationMethodService->store($request);

        if ($insertCalculationMethod) {
            return redirect()->back()->notify('success', __('language.success'), __('language.success_message'));
        } else {
            return redirect()->back()->notify('error', __('language.error'), __('language.error_message'));
        }
    }

    public function show(CalculationMethod $calculationMethod)
    {
        //
    }

    public function edit(CalculationMethod $calculationMethod)
    {
        return view('calculation-methods.edit', compact('calculationMethod'));
    }

    public function update(CalculationMethodRequest $request, CalculationMethod $calculationMethod, CalculationMethodService $calculationMethodService)
    {
        $updateCalculationMethod = $calculationMethodService->update($request, $calculationMethod);

        if ($updateCalculationMethod) {
            return redirect()->back()->notify('success', __('language.success'), __('language.success_message'));
        } else {
            return redirect()->back()->notify('error', __('language.error'), __('language.error_message'));
        }
    }

    public function destroy(CalculationMethod $calculationMethod)
    {
        $deleteCalculationMethod = $calculationMethod->delete();

        if ($deleteCalculationMethod) {
            return redirect()->route('calculation-methods.index')->notify('success', __('language.success'), __('language.success_message'));
        } else {
            return redirect()->back()->notify('error', __('language.error'), __('language.error_message'));
        }
    }
}
