<?php

use App\Http\Controllers\TiposdocumentoController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RegionalController;

Route::get('/', function () {
    return view('welcome');

});

Route::get('/Regional', [\App\Http\Controllers\RegionalController::class, 'index'])->name('Regional.index');
Route::get('/Regional/create', [\App\Http\Controllers\RegionalController::class, 'create'])->name('Regional.create');
Route::post('/Regional/store', [\App\Http\Controllers\RegionalController::class, 'store'])->name('Regional.store');

Route::get('/alternativaep', [\App\Http\Controllers\AlternativaepController::class, 'index'])->name('alternativaep.index');
Route::get('/alternativaep/create', [\App\Http\Controllers\AlternativaepController::class, 'create'])->name('alternativaep.create');
Route::post('/alternativaep/store', [\App\Http\Controllers\AlternativaepController::class, 'store'])->name('alternativaep.store');

Route::get('/Aprendices', [\App\Http\Controllers\AprendicesController::class, 'index'])->name('Aprendices.index');
Route::get('/Aprendices/create', [\App\Http\Controllers\AprendicesController::class, 'create'])->name('Aprendices.create');
Route::post('/Aprendices/store', [\App\Http\Controllers\AprendicesController::class, 'store'])->name('Aprendices.store');

Route::get('/Centrodeformacion', [\App\Http\Controllers\CentrodeformacionController::class, 'index'])->name('Centrodeformacion.index');
Route::get('/Centrodeformacion/create', [\App\Http\Controllers\CentrodeformacionController::class, 'create'])->name('Centrodeformacion.create');
Route::post('/Centrodeformacion/store', [\App\Http\Controllers\CentrodeformacionController::class, 'store'])->name('Centrodeformacion.store');

Route::get('/enteconformador', [\App\Http\Controllers\EnteconformadorController::class, 'index'])->name('enteconformador.index');
Route::get('/enteconformador/create', [\App\Http\Controllers\EnteconformadorController::class, 'create'])->name('enteconformador.create');
Route::post('/enteconformador/store', [\App\Http\Controllers\EnteconformadorController::class, 'store'])->name('enteconformador.store');

Route::get('/Fichadecaracterizacion', [\App\Http\Controllers\FichadecaracterizacionController::class, 'index'])->name('Fichadecaracterizacion.index');
Route::get('/Fichadecaracterizacion/create', [\App\Http\Controllers\FichadecaracterizacionController::class, 'create'])->name('Fichadecaracterizacion.create');
Route::post('/Fichadecaracterizacion/store', [\App\Http\Controllers\FichadecaracterizacionController::class, 'store'])->name('Fichadecaracterizacion.store');

Route::get('/Instructor', [\App\Http\Controllers\InstructorController::class, 'index'])->name('Instructor.index');
Route::get('/Instructor/create', [\App\Http\Controllers\InstructorController::class, 'create'])->name('Instructor.create');
Route::post('/Instructor/store', [\App\Http\Controllers\InstructorController::class, 'store'])->name('Instructor.store');

Route::get('/programadeformacion', [\App\Http\Controllers\ProgramadeformacionController::class, 'index'])->name('programadeformacion.index');
Route::get('/programadeformacion/create', [\App\Http\Controllers\ProgramadeformacionController::class, 'create'])->name('programadeformacion.create');
Route::post('/programadeformacion/store', [\App\Http\Controllers\ProgramadeformacionController::class, 'store'])->name('programadeformacion.store');

Route::get('/rolesadministrativos', [\App\Http\Controllers\RolesadministrativosController::class, 'index'])->name('rolesadministrativos.index');
Route::get('/rolesadministrativos/create', [\App\Http\Controllers\RolesadministrativosController::class, 'create'])->name('rolesadministrativos.create');
Route::post('/rolesadministrativos/store', [\App\Http\Controllers\RolesadministrativosController::class, 'store'])->name('rolesadministrativos.store');

Route::get('/Subalternativaep', [\App\Http\Controllers\SubalternativaepController::class, 'index'])->name('Subalternativaep.index');
Route::get('/Subalternativaep/create', [\App\Http\Controllers\SubalternativaepController::class, 'create'])->name('Subalternativaep.create');
Route::post('/Subalternativaep/store', [\App\Http\Controllers\SubalternativaepController::class, 'store'])->name('Subalternativaep.store');

/*
Route::get('/tiposdocumento', [\App\Http\Controllers\tiposdocumentoController::class, 'index'])->name('tiposdocumento.index');
Route::get('/tiposdocumento/create', [\App\Http\Controllers\tiposdocumentoController::class, 'create'])->name('tiposdocumento.create');
Route::post('/tiposdocumento/store', [\App\Http\Controllers\tiposdocumentoController::class, 'store'])->name('tiposdocumento.store');
Route::get('/tiposdocumento/{NIS}/edit', [tiposdocumentoController::class, 'edit'])
    ->name('tiposdocumento.edit');

Route::put('/tiposdocumento/{NIS}',
    [\App\Http\Controllers\tiposdocumentoController::class, 'update']
)->name('tiposdocumento.update');
*/
Route::resource('tiposdocumento', TiposdocumentoController::class);

Route::get('/tiposeps', [\App\Http\Controllers\tiposepsController::class, 'index'])->name('tiposeps.index');
Route::get('/tiposeps/create', [\App\Http\Controllers\tiposepsController::class, 'create'])->name('tiposeps.create');
Route::post('/tiposeps/store', [\App\Http\Controllers\tiposepsController::class, 'store'])->name('tiposeps.store');









//Route::resource('regional', RegionalController::class);
