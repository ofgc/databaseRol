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
    return view('welcome');
});

Auth::routes();
	
Route::get('/home', 'HomeController@index')->name('home');
//Route::get('datatables', 'DatatablesController@index');
/*
Route::resource('datatables', 'DatatablesController', [
    'data'  => 'datatables.data' ,
    'index' => 'datatables.index',
]);
*/

//Route::get('/datatablesindex', 'DatatablesController@index' );
//Route::get('/datatables', 'DatatablesController@data' ) -> name ('cosa');
Route::get('/datatables', 'DatatablesController@index');
Route::get('/datatablesdata', 'DatatablesController@getDatos' ) -> name ('usuarios');