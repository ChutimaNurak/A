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

Route::get('/home', function () {
    return view('home');
});

//Marker Animations With setTimeout()
Route::get('/test', function () {
    return view('test');
});

//Algorithm
Route::get('/test3', function () {
    return view('test3');
});


//Customer
Route::resource('/customer','CustomerController');
/*
Route::get('/customer', 'CustomerController@index');
Route::get('/customer/create', 'CustomerController@create');
Route::post('/customer', 'CustomerController@store');
Route::get('/customer/{id}', 'CustomerController@show');
Route::get('/customer/{id}/edit', 'CustomerController@edit');
Route::put('/customer/{id}', 'CustomerController@update');
Route::delete('/customer/{id}', 'CustomerController@destroy');
*/


//Postion
Route::resource('/position','PositionController');


//Job
Route::resource('/job','JobController');

Route::get('/job/{ID_Job}/pdf', 'JobController@downloadpdf');//PDF
Route::get('/excel/{ID_Job}','JobController@excel');//excel


//Route
Route::resource('/route', 'RouteController');
Route::get('/route/dis/{ID_Job}','RouteController@dis');
Route::get('/route/json/{ID_Job}','RouteController@json');