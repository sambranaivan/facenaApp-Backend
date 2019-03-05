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
    Route::get('/alertas','AlarmaController@alertas')->name('seleccionarAlerta');
    Route::post('/alertas','AlarmaController@verAlertaDetalle')->name('editarAlerta');
    Route::post('/editarAlerta','AlarmaController@editarAlerta')->name('guardarAlerta');;
    Route::get('/borrarAlerta/{id}','AlarmaController@borrarAlerta')->name('borrarAlerta');;
    Route::post('/updatefilters','UserController@updateFilters');
    // rutas de configuracion
    Route::get('/listaAlertas','AlarmaController@verListado')->name('alertas');
    Route::get('/config/lastid/{lastid}', 'ConfiguracionController@set');
    Route::get('/config/lastid/', 'ConfiguracionController@get');

});

Route::get('/checkupdate','AlertaController@checkUpdate');


///probar notificacion
Route::get('/test','AsuntoController@sendNotificacion');

Route::get('/pases/{departamento_id}','DepartamentoController@pasePorTomar')->name('pasesportomar');
Route::get('/endepartamento/{departamento_id}','DepartamentoController@paseEnDepartamento')->name('endepartamento');
Route::get('/departamentos','DepartamentoController@verDepartamentos')->name('departamentos');
Route::get('/rectorado','PaseController@desdeRectorado')->name('desdeRectorado');
Route::get('/runAlarma','AlarmaController@runAlarma')->name('runAlarma');
Route::get('/email','AlarmaController@send')->name('email');
