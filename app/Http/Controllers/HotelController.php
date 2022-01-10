<?php

namespace App\Http\Controllers;

use App\Helper\ImageHelper;
use App\Http\Requests\HotelRequest;
use App\Models\Hotel;
use App\Models\Region;
use App\Models\User;
use Illuminate\Support\Str;
use Nette\Utils\Image;

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
        $filename = Str::slug($request->name, '-');

        $image = ImageHelper::singleUpload($filename, 'images', $request->image);

        $insertHotel = Hotel::create([
            'name' => $request->name,
            'email' => $request->email,
            'manager_id' => $request->manager_id,
            'foreman_id' => $request->foreman_id,
            'region_id' => $request->region_id,
            'telephone' => $request->telephone,
            'city' => $request->city,
            'address' => $request->address,
            'image' => $image,
        ]);

        if ($insertHotel) {
            return redirect()->back()->notify('success', 'Success', 'The operation was successful.');
        } else {
            return redirect()->back()->notify('error', 'Error', 'An error occurred during the operation.');
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
        if ($request->image) {
            if ($request->name != $hotel->name) {
                ImageHelper::delete([
                    public_path('images') . '/' . $hotel->image
                ]);
            }

            $filename = Str::slug($request->name, '-');
            $image = ImageHelper::singleUpload($filename, 'images', $request->image);
        }

        $updateHotel = $hotel->update([
            'name' => $request->name,
            'email' => $request->email,
            'manager_id' => $request->manager_id,
            'foreman_id' => $request->foreman_id,
            'region_id' => $request->region_id,
            'telephone' => $request->telephone,
            'city' => $request->city,
            'address' => $request->address,
            'image' => $image ?? $hotel->image,
        ]);

        if ($updateHotel) {
            return redirect()->back()->notify('success', 'Success', 'The operation was successful.');
        } else {
            return redirect()->back()->notify('error', 'Error', 'An error occurred during the operation.');
        }
    }

    public function destroy(Hotel $hotel)
    {
        $deleteHotel = $hotel->delete();

        if ($deleteHotel) {
            ImageHelper::delete([
                public_path('images') . '/' . $hotel->image
            ]);

            return redirect()->route('hotels')->notify('success', 'Success', 'The operation was successful.');
        } else {
            return redirect()->back()->notify('error', 'Error', 'An error occurred during the operation.');
        }
    }
}
