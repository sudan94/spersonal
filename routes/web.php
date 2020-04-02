<?php

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

Route::get('/', function () {
    return view('website/index-image');
});
Route::get('/dashboard', function () {
    return view('dashboard/dashboard');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout','\App\Http\Controllers\Auth\LoginController@logout');
    Route::get('/resume','ResumeController@index')->name('resume');
    Route::post('/resume/insert','ResumeController@store');
    
});
