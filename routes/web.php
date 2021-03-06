<?php

use App\Http\Controllers\CalculationMethodController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\InputComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('lang/{language}', [LanguageController::class, 'switchLanguage'])->name('language.switch');

    Route::resource('users', UserController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('hotels', HotelController::class);
    Route::resource('calculation-methods', CalculationMethodController::class);

    Route::get('/inputs/{hotel}', [HotelController::class, 'inputs'])->name('inputs');

    Route::group(['as' => 'sheets.', 'prefix' => 'sheets'], function () {
        Route::get('/', [SheetController::class, 'index'])->name('index');
        Route::get('/inputs/employee', [SheetController::class, 'inputsByEmployee'])->name('inputs.employee');
        Route::get('/inputs/hotels', [SheetController::class, 'inputsByHotel'])->name('inputs.hotel');
    });

    //Route::get('/users', UserComponent::class)->name('users');
    //Route::get('/employees', EmployeeComponent::class)->name('employees');
    //Route::get('/hotels', HotelComponent::class)->name('hotels');
});

/*Route::get('/get-cities', function () {
    $source = Http::get('https://en.m.wikipedia.org/wiki/List_of_cities_in_Germany_by_population');
    $dot1 = explode('<table class="wikitable sortable">', $source);
    $dot2 = explode('</table>', $dot1[1]);

    preg_match_all('#<a href="/wiki/(.*?)" title="(.*?)">(.*?)</a>#si', $dot2[0], $data);
    unset($data[0][0]);

    for ($i = 1; $i <= count($data[0]); $i++) {

        if ($i % 2 == 0) {
            $state[] = $data[2][$i];
        } else {
            $city[] = $data[2][$i];
        }
    }

    $generateJson = json_encode(array_combine($city, $state));

    \Illuminate\Support\Facades\Storage::disk('local')->put('json/germany.json', $generateJson);
});*/

require __DIR__.'/auth.php';
