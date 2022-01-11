<?php

namespace App\Services;


use App\Helper\ImageHelper;
use App\Models\Hotel;
use Illuminate\Support\Str;

class HotelService {

    public function store($request)
    {
        $filename = Str::slug($request->name, '-');

        $image = ImageHelper::singleUpload($filename, 'images', $request->image);

        return Hotel::create([
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
    }

    public function update($request, $hotel)
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

        return $hotel->update([
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
    }
}
