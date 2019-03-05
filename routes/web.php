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
    Route::get('/asuntos','AsuntoController@verTodos');
    Route::get('/subscribe','AsuntoController@subscribe');
    Route::get('/unsubscribe','AsuntoController@unsubscribe');
    Route::get('/', 'AsuntoController@verAsuntos');

    Route::get('/superadmin','UserController@superAdmin')->name('superadmin');
    Route::get('/superadmin/alertas','AlarmaController@alertas');
    Route::post('/superadmin/alertas','AlarmaController@verAlertaDetalle');//TODO
    Route::post('/superadmin/editarAlerta','AlarmaController@editarAlerta');
    Route::post('/updatefilters','UserController@updateFilters');
    // rutas de configuracion
    Route::get('/superadmin/listaAlertas','AlarmaController@verListado');
    Route::get('/config/lastid/{lastid}', 'ConfiguracionController@set');
    Route::get('/config/lastid/', 'ConfiguracionController@get');

});

Route::get('/checkupdate','AlertaController@checkUpdate');


///probar notificacion
Route::get('/test','AsuntoController@sendNotificacion');

Route::get('/departamento/paseportomar/{departamento_id}','DepartamentoController@pasePorTomar');
Route::get('/departamento/paseendepartamento/{departamento_id}','DepartamentoController@paseEnDepartamento');
