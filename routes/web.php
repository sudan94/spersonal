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

Route::get('/', 'WebsiteController@index');
Route::get('/blog/{id}', 'WebsiteController@show');


Route::get('/dashboard', function () {
    return view('dashboard/dashboard');
})->middleware('auth');
Route::get('/single', function () {
    return view('website/single-blog');
});

Route::middleware(['auth'])->group(function () {
    // resume start
    Route::get('/logout','\App\Http\Controllers\Auth\LoginController@logout');
    Route::get('/resume','ResumeController@index')->name('resume');
    Route::post('/resume/insert','ResumeController@store');
    Route::get('/getresume','ResumeController@allResume');
    Route::post('/resume/delete','ResumeController@destroy');
    Route::post('/resume/edit','ResumeController@edit');
    Route::post('/resume/update','ResumeController@update');
    // resume end

    // skill start
    Route::get('/skill','SkillController@index')->name('skill');
    Route::post('/skill/insert','SkillController@store');
    Route::get('/getskills','SkillController@allSkills');
    Route::post('/skill/status','SkillController@status');
    Route::post('/skill/delete','SkillController@destroy');
    Route::post('/skill/edit/{id}','SkillController@edit');
    Route::post('/skill/update','SkillController@update');
    // skill end

    // Blog start\
    Route::get('/blog','BlogController@index');
    Route::post('/blog/insert','BlogController@store');
    Route::get('/getblog','BlogController@allBlog');
    Route::post('/blog/status','BlogController@status');
    Route::get('/blog/delete/{id}','BlogController@destroy');
    Route::get('/blog/single/{id}','BlogController@show');
    Route::get('/blog/edit/{id}','BlogController@edit');
    Route::post('/blog/update/','BlogController@update');
    // Blog end

    // user start
    Route::get('/user','UserController@index');
    Route::post('/user/image','UserController@image');
    //  user end
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
