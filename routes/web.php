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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function () {
    //
    Route::get('/asuntos','AsuntoController@viewAsuntos');
    Route::get('/subscribe','AsuntoController@subscribe');
    Route::get('/unsubscribe','AsuntoController@unsubscribe');
    Route::get('/', 'AsuntoController@verAsuntos');

});

Route::get('/checkupdate','AlertaController@checkUpdate');


///probar notificacion
Route::get('/test','AsuntoController@sendNotificacion');

// semi api
