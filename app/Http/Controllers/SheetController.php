<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SheetController extends Controller
{
    public function index()
    {
        return view('sheets.index');
    }

    public function inputsByEmployee()
    {
        return view('sheets.inputs.employee');
    }

    public function inputsByHotel()
    {
        return view('sheets.inputs.hotel');
    }
}
