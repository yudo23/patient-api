<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(["middleware" => ["jsonResponse", "accessKey"]], function () {
    Route::group(["as" => "patients.", "prefix" => "patients"], function () {
		Route::get('/', 'PatientController@index')->name("index");
		Route::get('/{id}', 'PatientController@show')->name("show");
		Route::post('/', 'PatientController@store')->name("store");
		Route::put('/{id}', 'PatientController@update')->name("update");
		Route::delete('/{id}', 'PatientController@destroy')->name("destroy");
	});
});
