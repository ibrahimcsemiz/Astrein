<?php

namespace App\Http\Controllers;

use App\Http\Requests\Hotel\StoreHotelRequest;
use App\Http\Requests\Hotel\UpdateHotelRequest;
use App\Models\Hotel;
use App\Models\Region;
use App\Models\User;
use Illuminate\Support\Str;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $regions = Region::all();

        return view('hotels.create', [
            'users' => $users,
            'regions' => $regions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHotelRequest $request)
    {
        $insertHotel = Hotel::create([
            'name' => Str::title($request->input('name')),
            'email' => $request->input('email'),
            'manager_id' => $request->input('manager_id'),
            'foreman_id' => $request->input('foreman_id'),
            'region_id' => $request->input('region_id'),
            'telephone' => $request->input('telephone'),
            'city' => $request->input('city'),
            'address' => $request->input('address')
        ]);

        if ($insertHotel) {
            return redirect()->back()->with('status', 'success')->with('message', 'The operation was successful.');
        } else {
            return redirect()->back()->with('status', 'error')->with('message', 'An error occurred during the operation.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotel = Hotel::exists($id);

        if (!$hotel) {
            return redirect(url('hotels'))->with('status', 'error')->with('message', 'Hotel not found.');
        }

        return view('hotels.show', [
            'data' => $hotel->with('manager')->with('foreman')->with('region')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotel = Hotel::exists($id);

        if (!$hotel) {
            return redirect(url('hotels'))->with('status', 'error')->with('message', 'Hotel not found.');
        }

        $users = User::all();
        $regions = Region::all();

        return view('hotels.edit', [
            'data' => $hotel->get(),
            'users' => $users,
            'regions' => $regions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHotelRequest $request, $id)
    {
        $hotel = Hotel::exists($id);

        if (!$hotel) {
            return redirect(url('hotels'))->with('status', 'error')->with('message', 'Hotel not found.');
        }

        $updateHotel = $hotel->update([
            'name' => Str::title($request->input('name')),
            'email' => $request->input('email'),
            'manager_id' => $request->input('manager_id'),
            'foreman_id' => $request->input('foreman_id'),
            'region_id' => $request->input('region_id'),
            'telephone' => $request->input('telephone'),
            'city' => $request->input('city'),
            'address' => $request->input('address')
        ]);

        if ($updateHotel) {
            return redirect()->back()->with('status', 'success')->with('message', 'The operation was successful.');
        } else {
            return redirect()->back()->with('status', 'error')->with('message', 'An error occurred during the operation.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel = Hotel::exists($id);

        if (!$hotel) {
            return redirect(url('hotels'))->with('status', 'error')->with('message', 'Hotel not found.');
        }

        $deleteHotel = $hotel->delete();

        if ($deleteHotel) {
            return redirect(url('hotels'))->with('status', 'success')->with('message', 'The operation was successful.');
        } else {
            return redirect()->back()->with('status', 'error')->with('message', 'An error occurred during the operation.');
        }
    }
}
