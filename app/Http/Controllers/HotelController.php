<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Models\Hotel;
use App\Models\Region;
use App\Models\User;

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

    public function store(HotelRequest $request)
    {
        $insertHotel = Hotel::create([
            'name' => $request->name,
            'email' => $request->email,
            'manager_id' => $request->manager_id,
            'foreman_id' => $request->foreman_id,
            'region_id' => $request->region_id,
            'telephone' => $request->telephone,
            'city' => $request->city,
            'address' => $request->address
        ]);

        if ($insertHotel) {
            return redirect()->back()->with('status', 'success')->with('message', 'The operation was successful.');
        } else {
            return redirect()->back()->with('status', 'error')->with('message', 'An error occurred during the operation.');
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

    public function update(HotelRequest $request, Hotel $hotel)
    {
        $updateHotel = $hotel->update([
            'name' => $request->name,
            'email' => $request->email,
            'manager_id' => $request->manager_id,
            'foreman_id' => $request->foreman_id,
            'region_id' => $request->region_id,
            'telephone' => $request->telephone,
            'city' => $request->city,
            'address' => $request->address
        ]);

        if ($updateHotel) {
            return redirect()->back()->with('status', 'success')->with('message', 'The operation was successful.');
        } else {
            return redirect()->back()->with('status', 'error')->with('message', 'An error occurred during the operation.');
        }
    }

    public function destroy(Hotel $hotel)
    {
        $deleteHotel = $hotel->delete();

        if ($deleteHotel) {
            return redirect(url('hotels'))->with('status', 'success')->with('message', 'The operation was successful.');
        } else {
            return redirect()->back()->with('status', 'error')->with('message', 'An error occurred during the operation.');
        }
    }
}
