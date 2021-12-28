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
        $users = User::whereIn('function', ['Manager', 'Foreman'])
            ->get();

        $regions = Region::all();

        return view('hotels.create', [
            'managers' => $users->where('function', 'Manager'),
            'foremans' => $users->where('function', 'Foreman'),
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
        if (!Hotel::exists($id)) {
            return redirect(url('hotels'))->with('status', 'error')->with('message', 'Hotel not found.');
        }

        return view('hotels.show', [
            'data' => Hotel::where('id', $id)->with('manager')->with('foreman')->with('region')->get(),
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
        if (!Hotel::exists($id)) {
            return redirect(url('hotels'))->with('status', 'error')->with('message', 'Hotel not found.');
        }

        $users = User::whereIn('function', ['Manager', 'Foreman'])
            ->get();

        $regions = Region::all();

        return view('hotels.edit', [
            'data' => Hotel::where('id', $id)->get(),
            'managers' => $users->where('function', 'Manager'),
            'foremans' => $users->where('function', 'Foreman'),
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
        if (!Hotel::exists($id)) {
            return redirect(url('hotels'))->with('status', 'error')->with('message', 'Hotel not found.');
        }

        $hotel = Hotel::where('id', $id)->first();

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
        if (!Hotel::exists($id)) {
            return redirect(url('hotels'))->with('status', 'error')->with('message', 'Hotel not found.');
        }

        $deleteHotel = Hotel::where('id', $id)->delete();

        if ($deleteHotel) {
            return redirect(url('hotels'))->with('status', 'success')->with('message', 'The operation was successful.');
        } else {
            return redirect()->back()->with('status', 'error')->with('message', 'An error occurred during the operation.');
        }
    }
}
