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

Route::get('/mails/send',"MailController@send")->name('sendMail');///evniar mail cada dia a cada hora
Route::get('/checkChanges',"SeguimientoController@checkUpdate")->name("checkSeguimiento");///Seguimiento de expedientes FOLLOW regreso de rectorado

Route::get('/mapuche/getJson',"mapucheController@getJson")->name('getMapuche');
Route::get('/usuarios',"UserController@index")->name('usuarios');


Route::get('/usuarios/new',"UserController@new")->name('newUser');
Route::post('/usuarios/create',"UserController@create")->name('createUser');
Route::get('/usuarios/setPermision/{user_id}/{permision}/{status}',"UserController@setPermission")->name('setPermision');


Route::group(['middleware' => ['auth']], function () {

    // necesito middleware por la sesion
    Route::get("/expediente/ingorar/{numero}","ExpedienteController@ignorar")->name("ingorar");
    Route::get("/expediente/ingorar/","ExpedienteController@ignorar")->name("ocultarjs");
    Route::get("/rectorado/omitidos/","DepartamentoController@ocultos")->name("verOcultos");
    Route::get("/expediente/recuperar/{id}","ExpedienteController@restaurar")->name("recuperar");
    Route::get("/expediente/recuperar/","ExpedienteController@ignorar")->name("recuperarjs");

    Route::get("/mails/editor","MailController@index")->name('editorMail');
    //
    Route::get('/mapuche',"mapucheController@index")->name("mapuche");
    Route::post('/mails/save',"MailController@save")->name('guardarMail');

    Route::get('/mails/edit/{id}',"MailController@edit")->name('editarMail');
    Route::get('/mails/delete/{id}',"MailController@delete")->name('borrarMail');
    Route::post('/mails/update',"MailController@update")->name('actualizarMail');

    Route::get('/mails',"MailController@listado")->name('listadoMails');
    Route::get('/exp/seguir/{id}',"SeguimientoController@seguir")->name('seguirExpediente');
    Route::get('/exp/unfollow/{id}',"SeguimientoController@unfollow")->name('unFollow');

    Route::get('/asuntostodos','AsuntoController@verTodos')->name('notificaciones_todos');///;//Ver todos los Asuntos
    Route::get('/asuntos', 'AsuntoController@verAsuntos')->name('notificaciones');///Ver Asuntos Filtrados
    Route::get('/', 'AsuntoController@verAsuntos')->name('notificaciones');///Ver Asuntos Filtrados
    // Route::get('/', 'HomeController@index');///Ver Asuntos Filtrados
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
Route::post('/endepartamento', 'DepartamentoController@paseEnDepartamentoFilter')->name('endepartamentoFilter');
Route::get('/departamentos','DepartamentoController@verDepartamentos')->name('departamentos');
Route::get('/rectorado','DepartamentoController@rectorado')->name('rectorado');
Route::get('/movimientos/{exp}','DepartamentoController@movimientos')->name('movimientos');
Route::get('/consejo','DepartamentoController@consejo')->name('consejo');
Route::get('test/consejo','DepartamentoController@consejo_test')->name('consejo_test');

});

Route::get('/buscar_expediente', function(){
    return view('buscar_expediente');
})->name('buscar_expediente');

// Route::get("/del/{user_id}",'UserController@borrar');
///probar notificacion
Route::get('/test','AsuntoController@sendNotificacion');
Route::get('/test/notification','NotificationController@getNotifications');

Route::get('/expediente/{hash}','ExpedienteController@verExpediente')->name('verExpediente');
Route::get('/expediente',function(){
return view('expediente_error');
});
Route::post('/buscar_expediente','ExpedienteController@buscarExpediente')->name('buscarExpediente');


////acciones CRON
Route::get('/checkupdate','AlertaController@checkUpdate');///notificacion via app movil segun asunto
Route::get('/runAlarma','AlarmaController@runAlarma')->name('runAlarma');//Alarmas semanales de vencimiento de pases en el departamente
Route::get('semanal','AlarmaController@semanal');///Alarmas de pases en espera
Route::get('testmail','AlarmaController@probarMail');


////parte de registros
Route::get('/registros','RegistroController@test');
Route::get("/consulta",'ExpedienteController@ema');

Route::get('/etiquetas',function(){
    return view('barcode');
})->name('etiquetas');

Route::post('/etiquetas','HomeController@print')->name('barcode');

Route::get("/del",'UserController@del');


Route::get('random','HomeController@fillBarcode');
Route::get('widget',function(){
    return view("widget");
});
Route::get('widget2',function(){
    return view("widget2");
});

//*sueldo*/
Route::get('sueldos','sueldoController@home');

Route::post('sueldos','sueldoController@calcula');






