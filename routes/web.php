<?php
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AdminPoaController;
use App\Http\Controllers\CortoPlazoAccionController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\DirectrizPoaController;
use App\Http\Controllers\EstadoTrabajadorController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\GerenciaController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedianoPlazoAccionController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\OperacionController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\PeiObjetivoEspecificoController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PilarController;
use App\Http\Controllers\PlanificacionController;
use App\Http\Controllers\PoaController;
use App\Http\Controllers\PresupuestosRequeridosController;
use App\Http\Controllers\ResultadoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TareaEspecificaController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\UsuarioController;
use App\Models\CortoPlazoAcciones;
use Illuminate\Support\Facades\Route;

Route::get('/pruebas', [NotificacionController::class, 'pruebas']);

Route::get('/gridjs', function() {
    return view('gridjs');
});

Route::get('/axios', function() {
    return view('axios');
});

Route::get('/welcome', function ($request) {
    return view('welcome');
});

Route::view('/', 'login')->name('login');

//con el middleware indicamos que si no estamos autenticados no nos deje entrar a la ruta principal aumentando url
//protegemos la ruta con middleware para que usuarios no autenticados no puedan ingresar

//Route::view('principal', 'principal')->middleware('auth')->name('principal');
//agregamos el ::usuario para que el guard usuario pueda ingresar a esta ruta

Route::view('/index', [IndexController::class, 'index'])->name('index_principal');

Route::view('principal', [UsuarioController::class, 'principal'])->middleware('auth:usuario')->name('principal');

Route::post('/autenticacion', [LoginController::class, 'autenticacion'])->name('autenticacion');

Route::post('logout', [LoginController::class, 'logout']);

//************************************* USUARIOS ****************************************
Route::get('/selectTrabajadores', [UsuarioController::class, 'selectTrabajador']);
Route::get('/rolesUsuario/{usuario}', [UsuarioController::class, 'rolesUsuario']);
Route::resource('/usuarios', UsuarioController::class)->middleware('auth:usuario')->only('index', 'store', 'update', 'destroy')->parameters([ // cambiando el parametro de la variable que recibimos /usuario/{usuario}
    'usuarios' => 'usuario'] //solo cambiamos el nombre del parametro para entender que sera un objeto en el controlador
);
//creamos la ruta para el datatable con ajax recupere los datos
// Route::get('datatable/usuario', [DatatableController::class, 'listarUsuario'] )->name('datatable.usuario');
Route::get('consulta', [DatatableController::class, 'consulta'] );

//************************************* GERENCIAS **************************************
//Route::get('gerencias/index', [GerenciaController::class, 'index'])->name('gerencias.index');
// Route::get('datatable/gerencias', [DatatableController::class, 'listarGerencia'] )->name('datatable.gerencias');
Route::resource('gerencias', GerenciaController::class)->only('index', 'store', 'update', 'destroy');

//*************************************** UNIDADES *************************************
// Route::get('datatable/unidad', [DatatableController::class, 'listarUnidad'] )->name('datatable.unidad');
Route::resource('unidades', UnidadController::class)->only('index', 'store', 'update', 'destroy')
    ->parameters([
        // cambiando el parametro de la variable que recibimos /usuario/{usuario}
        'unidades' => 'unidad'
    ]); //solo cambiamos el nombre del parametro para entender que sera un objeto en el controlador

//************************************** TRABAJADORES ************************************
Route::resource('trabajadores', TrabajadorController::class)->only('index', 'store', 'update', 'destroy')->parameters([
    'trabajadores' => 'trabajador'
])->middleware('auth:usuario');

//************************************** PILARES **************************************
Route::resource('pilares', PilarController::class)->only('index', 'store', 'update', 'destroy')->parameters([
    'pilares' => 'pilar'
]);

//************************************** METAS ***************************************
Route::get('pilares/{pilar}/metas', [MetaController::class, 'index'] )->name('metas.index');
Route::post('metas/{pilar}', [MetaController::class, 'store']);
Route::resource('metas', MetaController::class)->only('update', 'destroy')->parameters([
    'metas' => 'meta'
]);

//************************************** RESULTADOS **********************************
Route::get('metas/{meta}/resultados', [ResultadoController::class, 'index'] )->name('resultados.index');
Route::post('resultados/{meta}', [ResultadoController::class, 'store'])->name('resultados.store');
Route::resource('resultados', ResultadoController::class)->only('update', 'destroy');

//********************************** MEDIANO PLAZO ACCIONES ****************************
Route::get('resultados/{resultado}/acciones_mediano_plazo', [MedianoPlazoAccionController::class, 'index'] )->name('mediano_plazo_accion.index');
Route::post('mediano_plazo_acciones/{resultado}', [MedianoPlazoAccionController::class, 'store']);
Route::resource('mediano_plazo_acciones', MedianoPlazoAccionController::class)->only('update', 'destroy')->parameters([
    'mediano_plazo_acciones' => 'mediano_plazo_accion'
]);

//************************************ PEI OBJETIVOS ESPECIFICOS ****************************
Route::get('mediano_plazo_acciones/{mediano_plazo_accion}/pei_objetivos_especificos', [PeiObjetivoEspecificoController::class, 'index'])->name('pei.index');
Route::post('pei_objetivos_especificos/{mediano_plazo_accion}', [PeiObjetivoEspecificoController::class, 'store']);
Route::resource('pei_objetivos_especificos', PeiObjetivoEspecificoController::class)->only('update', 'destroy')->parameters([
    'pei_objetivos_especificos' => 'pei_objetivo_especifico'
]);

//************************************** ESTADO TRABAJADORES **********************************
// Route::get('datatable/estados_trabajadores/', [DatatableController::class, 'estadoTrabajadores'] );
Route::get('estados_trabajadores', [EstadoTrabajadorController::class, 'index'])->name('estados_trabajadores.index');
Route::put('estados_trabajadores/poa_status/{id}', [EstadoTrabajadorController::class, 'poa_status']);
Route::put('estados_trabajadores/poa_evaluacion/{id}', [EstadoTrabajadorController::class, 'poa_evaluacion']);
Route::get('estados_trabajadores/habilitar_creacion_all', [EstadoTrabajadorController::class, 'habilitar_creacion_all']);
Route::get('estados_trabajadores/deshabilitar_creacion_all', [EstadoTrabajadorController::class, 'deshabilitar_creacion_all']);

//*************************************** CREACION POA ***********************************
Route::get('poa', [PoaController::class, 'index'])->name('poa.index');
// Route::get('datatable/poa', [DatatableController::class, 'listarPoas'] );

//************************************** CORTO PLAZO ACCIONES **************************
Route::get('/pei_objetivos_especifico/{pei_objetivo_especifico}/corto_plazo_acciones', [CortoPlazoAccionController::class, 'index']);
Route::post('corto_plazo_acciones/{pei_objetivo_especifico}', [CortoPlazoAccionController::class, 'store']);
Route::resource('corto_plazo_acciones', CortoPlazoAccionController::class)->only('update', 'destroy')->parameters([
    'corto_plazo_acciones' => 'corto_plazo_accion'
]);
Route::get('/planificacion_evaluacion', [CortoPlazoAccionController::class, 'planificacion_evaluacion'])->name('planificacion_evaluacion');

//************************************ ADMIN POA ************************************
Route::get('admin_poa', [AdminPoaController::class, 'index'])->name('admin_poa.index');
Route::get('status_corto_plazo_accion/{id}', [CortoPlazoAccionController::class, 'StatusCortoPlazoAccion']);
Route::put('admin_poa/{id}', [AdminPoaController::class, 'updateStatusAccionCortoPlazo']);

//*********************************** NOTIFICACIONES ********************************
Route::get('notificacion', [NotificacionController::class, 'CountStatusAccionesCorto']);

//************************************ OPERACIONES ***********************************
Route::get('corto_plazo_acciones/{corto_plazo_accion}/operaciones', [OperacionController::class, 'index'])->name('operacion.index');
Route::post('operaciones/{corto_plazo_accion}', [OperacionController::class, 'store']);
Route::resource('operaciones', OperacionController::class)->only('update', 'destroy')->parameters([
    'operaciones' => 'operacion'
]);

//************************************** PLANIFICACION ********************************/
Route::get('/planificacion/{corto_plazo_accion}', [PlanificacionController::class, 'index']);
Route::post('/planificacion/{corto_plazo_accion}', [PlanificacionController::class, 'store']);
Route::delete('planificacion/{planificacion}', [PlanificacionController::class, 'destroy']);

//************************************* ACTIVIDADES ***********************************
Route::get('/operaciones/{operacion}/actividades', [ActividadController::class, 'index'])->name('actividad.index');
Route::post('actividades/{operacion}', [ActividadController::class, 'store'])->name('actividad.store');
Route::resource('actividades', ActividadController::class)->only('update', 'destroy')->parameters([
    'actividades' => 'actividad']
);

//************************************ TAREAS ESPECIFICAS *******************************/
Route::get('actividades/{actividad}/tareas_especificas', [TareaEspecificaController::class, 'index']);
Route::post('tareas_especificas/{actividad}', [TareaEspecificaController::class, 'store']);
Route::resource('/tareas_especificas', TareaEspecificaController::class)->only('update', 'destroy')->parameters([
    'tareas_especificas' => 'tarea_especifica'
]);

//************************************** PARTIDAS *************************************************/
// Route::get('/datatable/partidas', [DatatableController::class, 'listarPartidas']);
Route::resource('/partidas', PartidaController::class)->only('index', 'store', 'update', 'destroy');

//************************************* ITEMS ***********************************************/
Route::get('/actividades/{actividad}/items', [ItemController::class, 'index'])->name('items.index');
Route::post('/items/{actividad}', [ItemController::class, 'store']);
Route::resource('/items', ItemController::class)->only('update', 'destroy');

/***************************************** EVALUACIONES ************************************/
Route::get('/evaluacion/{corto_plazo_accion}', [EvaluacionController::class, 'index']);

/****************************************** ROLES ******************************************/
Route::resource('/roles', RoleController::class)->only('index', 'store', 'update', 'destroy');
Route::get('/permisos_rol/{role}', [RoleController::class, 'permisos_rol']);

/****************************************** PERMISOS ******************************************/
Route::resource('/permissions', PermissionController::class)->only('index', 'store', 'update', 'destroy');

/****************************************** DIRECTRIZ_POA ******************************************/
// Route::resource('/directriz_poa', DirectrizPoaController::class)->only('index');
Route::get('/directriz_pdf', [DirectrizPoaController::class, 'directriz_pdf'])->name('directriz_pdf');

/************************************** REPORTE OPERACIONES Y TAREAS ******************************************/
Route::get('operaciones_tareas/{trabajador}', [EstadoTrabajadorController::class, 'operaciones_tareas'])->name('operaciones_tareas.index');
Route::get('operaciones_tareas_pdf/{trabajador}', [EstadoTrabajadorController::class, 'operaciones_tareas_pdf'])->name('operaciones_tareas_pdf');

/************************************** PRESUPUESTOS REQUERIDOS ******************************************/
Route::get('presupuestos_requeridos', [PresupuestosRequeridosController::class, 'lista_presupuestos'])->name('index.presupuestos');
Route::get('presupuestos_pdf/{f_inicio?}/{f_fin?}', [PresupuestosRequeridosController::class, 'presupuestos_pdf'])->name('presupuestos.pdf');