<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Ruta home
Route::get('/home', 'HomeController@index')->name('home');

//Ruta crear examen
Route::get('/create', 'HomeController@create');
//Ruta ranking
Route::get('/rank', 'HomeController@rank');

//Editar examen
Route::get('/editarExamen/{id}', 'HomeController@editarExamen')->name('editarExamen');
Route::post('/edicionExamen', 'HomeController@edicionExamen');
//Hacer examen
Route::get('/do/{id}', 'HomeController@do')->name('do');
// Rellenando el formulario subirexamen con metodo post
Route::post('/subirExamen', 'HomeController@subirExamen');
Route::post('/hacerExamen', 'HomeController@hacerExamen');
//Ver examen
Route::get('/verExamen/{id}', 'HomeController@verExamen')->name('verExamen');