<?php

namespace App\Http\Controllers;

use App\Helper\ImageHelper;
use App\Http\Requests\HotelRequest;
use App\Models\Hotel;
use App\Models\Region;
use App\Models\User;
use App\Services\HotelService;

class HotelController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        $managers = User::where('function', 'Manager')->get();
        $foremans = User::where('function', 'Foreman')->get();

        $regions = Region::all();

        return view('hotels.create', compact('managers', 'foremans', 'regions'));
    }

    public function store(HotelRequest $request, HotelService $hotelService)
    {
        $insertHotel = $hotelService->store($request);

        if ($insertHotel) {
            return redirect()->back()->notify('success', __('language.success'), __('language.success_message'));
        } else {
            return redirect()->back()->notify('error', __('language.error'), __('language.error_message'));
        }
    }

    public function show(Hotel $hotel)
    {
        $hotel->load(['manager', 'foreman', 'region']);

        return view('hotels.show', compact('hotel'));
    }

    public function edit(Hotel $hotel)
    {
        $managers = User::where('function', 'Manager')->get();
        $foremans = User::where('function', 'Foreman')->get();

        $regions = Region::all();

        return view('hotels.edit', compact('hotel', 'managers', 'foremans', 'regions'));
    }

    public function update(HotelRequest $request, Hotel $hotel, HotelService $hotelService)
    {
        $updateHotel = $hotelService->update($request, $hotel);

        if ($updateHotel) {
            return redirect()->back()->notify('success', __('language.success'), __('language.success_message'));
        } else {
            return redirect()->back()->notify('error', __('language.error'), __('language.error_message'));
        }
    }

    public function destroy(Hotel $hotel)
    {
        $deleteHotel = $hotel->delete();

        if ($deleteHotel) {
            ImageHelper::delete([
                public_path('images') . '/' . $hotel->image
            ]);

            return redirect()->route('hotels')->notify('success', __('language.success'), __('language.success_message'));
        } else {
            return redirect()->back()->notify('error', __('language.error'), __('language.error_message'));
        }
    }
}
