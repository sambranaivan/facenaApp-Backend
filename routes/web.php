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

// Route::get('/', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function () {
    //
    Route::get('/asuntostodos','AsuntoController@verTodos')->name('notificaciones_todos');///;//Ver todos los Asuntos
    Route::get('/asuntos', 'AsuntoController@verAsuntos')->name('notificaciones');///Ver Asuntos Filtrados

    Route::get('/subscribe','AsuntoController@subscribe')->name('subscribe');///API subscribirse a un asusnto para notificaciones
    Route::get('/unsubscribe','AsuntoController@unsubscribe')->name('unsubscribe');///API desubscribirse a un asusnto para notificaciones

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
    Route::get('/config/users/', 'UserController@userList');//TODO


    Route::get('/pases/{departamento_id}','DepartamentoController@pasePorTomar')->name('pasesportomar');
Route::get('/endepartamento/{departamento_id}','DepartamentoController@paseEnDepartamento')->name('endepartamento');
Route::get('/departamentos','DepartamentoController@verDepartamentos')->name('departamentos');
Route::get('/rectorado','DepartamentoController@rectorado')->name('rectorado');
Route::get('/movimientos/{exp}','DepartamentoController@movimientos')->name('movimientos');


});

Route::get('/', function(){
    return view('buscar_expediente');
})->name('buscar_expediente');


///probar notificacion
Route::get('/test','AsuntoController@sendNotificacion');

Route::get('/expediente/{hash}','ExpedienteController@verExpediente')->name('verExpediente');
Route::post('/buscar_expediente','ExpedienteController@buscarExpediente')->name('buscarExpediente');


////acciones CRON
Route::get('/checkupdate','AlertaController@checkUpdate');
Route::get('/runAlarma','AlarmaController@runAlarma')->name('runAlarma');
Route::get('testmail','AlarmaController@probarMail');


////parte de registros
Route::get('/registros','RegistroController@test');


Route::get('/etiquetas',function(){
    return view('barcode');
})->name('etiquetas');

Route::post('/etiquetas','HomeController@print')->name('barcode');
