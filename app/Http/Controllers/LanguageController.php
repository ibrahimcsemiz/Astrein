<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLanguage($language)
    {
        if (array_key_exists($language, Config::get('languages'))) {
            Session::put('language', $language);
        }

        return redirect()->back();
    }
}
